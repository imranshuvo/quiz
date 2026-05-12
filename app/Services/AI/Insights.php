<?php

namespace App\Services\AI;

use App\Enums\AiUsageKind;
use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\EnumSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

/**
 * Summarizes the responses to a questionnaire — themes, overall sentiment,
 * and a short executive summary. Persists the result onto
 * questionnaire.settings['insights'] so the analytics UI in Phase 6 can
 * just read it.
 */
class Insights
{
    public function __construct(protected Brain $brain)
    {
    }

    /**
     * @return array{themes: array<int, array{label: string, supporting_quote: string}>, sentiment: string, summary: string}|null
     */
    public function analyzeQuestionnaire(Questionnaire $questionnaire, int $maxResponsesSampled = 200): ?array
    {
        $textSamples = $this->collectTextSamples($questionnaire, $maxResponsesSampled);
        if (empty($textSamples)) {
            return null;
        }

        $structured = $this->brain->structured(
            kind: AiUsageKind::Insights,
            prompt: $this->buildPrompt($questionnaire, $textSamples),
            schema: $this->responseSchema(),
            system: 'You are a concise, neutral analyst. Summarize what respondents said. Quote only what they actually wrote — never invent.',
            workspace: $questionnaire->workspace,
            userId: null,
            meta: [
                'questionnaire_id' => $questionnaire->id,
                'sampled_responses' => count($textSamples),
            ],
        );

        if (! is_array($structured) || empty($structured)) {
            return null;
        }

        $insights = [
            'themes' => $structured['themes'] ?? [],
            'sentiment' => (string) ($structured['sentiment'] ?? 'mixed'),
            'summary' => (string) ($structured['summary'] ?? ''),
            'generated_at' => now()->toIso8601String(),
        ];

        $settings = $questionnaire->settings ?? [];
        $settings['insights'] = $insights;
        $questionnaire->forceFill(['settings' => $settings])->save();

        return $insights;
    }

    /**
     * Pull a flat list of text answers across the questionnaire's text-type
     * questions. We keep them associated with their question titles so the
     * AI can attribute themes back to the right prompt.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    protected function collectTextSamples(Questionnaire $questionnaire, int $limit): array
    {
        $textQuestionIds = $questionnaire->questions()
            ->whereIn('type', [QuestionType::ShortText->value, QuestionType::LongText->value])
            ->pluck('id', 'id');

        if ($textQuestionIds->isEmpty()) {
            return [];
        }

        $titles = $questionnaire->questions()
            ->whereIn('id', $textQuestionIds)
            ->pluck('title', 'id');

        $samples = [];
        $questionnaire->responses()
            ->where('status', ResponseStatus::Submitted)
            ->latest('submitted_at')
            ->limit($limit)
            ->get(['id'])
            ->each(function ($r) use (&$samples, $titles, $textQuestionIds) {
                $r->answers()
                    ->whereIn('question_id', $textQuestionIds->keys())
                    ->get(['question_id', 'value'])
                    ->each(function ($a) use (&$samples, $titles) {
                        $val = is_array($a->value) ? ($a->value[0] ?? '') : (string) $a->value;
                        $val = trim($val);
                        if ($val === '') {
                            return;
                        }
                        $samples[] = [
                            'question' => (string) ($titles[$a->question_id] ?? 'Question'),
                            'answer' => mb_substr($val, 0, 800),
                        ];
                    });
            });

        return $samples;
    }

    /**
     * @param  array<int, array{question: string, answer: string}>  $samples
     */
    protected function buildPrompt(Questionnaire $questionnaire, array $samples): string
    {
        $lines = ["Respondents answered the following questionnaire: \"{$questionnaire->title}\".", ''];
        $lines[] = 'Their open-ended answers (one per line, "Q: ... | A: ..."):';
        $lines[] = '';
        foreach ($samples as $s) {
            $lines[] = "Q: {$s['question']} | A: {$s['answer']}";
        }
        $lines[] = '';
        $lines[] = 'Identify the top 3-5 recurring themes across these responses. For each theme, attach one short verbatim quote (taken exactly from a response). Then give an overall sentiment label and a 2-3 sentence executive summary.';

        return implode("\n", $lines);
    }

    protected function responseSchema(): ObjectSchema
    {
        $themeSchema = new ObjectSchema(
            name: 'theme',
            description: 'A recurring topic across responses.',
            properties: [
                new StringSchema('label', 'Short, plain-language theme name (max 6 words).'),
                new StringSchema('supporting_quote', 'A short verbatim quote from one of the answers that exemplifies this theme.'),
            ],
            requiredFields: ['label', 'supporting_quote'],
        );

        return new ObjectSchema(
            name: 'insights_response',
            description: 'AI-summarized insights across questionnaire responses.',
            properties: [
                new ArraySchema('themes', 'Top 3-5 recurring themes.', items: $themeSchema),
                new EnumSchema('sentiment', 'Overall sentiment of the responses.', options: ['positive', 'mixed', 'negative']),
                new StringSchema('summary', '2-3 sentence executive summary of what respondents said.'),
            ],
            requiredFields: ['themes', 'sentiment', 'summary'],
        );
    }
}
