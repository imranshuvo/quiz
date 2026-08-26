<?php

namespace App\Services\AI;

use App\Enums\AiUsageKind;
use App\Enums\QuestionnaireKind;
use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\BooleanSchema;
use Prism\Prism\Schema\EnumSchema;
use Prism\Prism\Schema\NumberSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

/**
 * Asks the AI to draft questions for a topic, then persists them onto the
 * given questionnaire. Returns the persisted Question models.
 */
class QuestionGenerator
{
    public function __construct(protected Brain $brain) {}

    /**
     * @return array<int, Question> the persisted questions, in position order
     */
    public function generateForTopic(
        Questionnaire $questionnaire,
        string $topic,
        int $count = 5,
        ?int $userId = null,
    ): array {
        $count = max(1, min(20, $count));

        $structured = $this->brain->structured(
            kind: AiUsageKind::GenerateQuestions,
            prompt: $this->buildPrompt($questionnaire->kind, $topic, $count),
            schema: $this->responseSchema(),
            system: $this->systemPrompt($questionnaire->kind),
            workspace: $questionnaire->workspace,
            userId: $userId,
            meta: [
                'questionnaire_id' => $questionnaire->id,
                'topic' => mb_substr($topic, 0, 200),
                'count' => $count,
            ],
        );

        return $this->persist($questionnaire, $structured['questions'] ?? []);
    }

    protected function systemPrompt(QuestionnaireKind $kind): string
    {
        return match ($kind) {
            QuestionnaireKind::Assessment => 'You are an expert quiz writer. Write clear, unambiguous questions and mark exactly one correct option per question (or multiple if the type is multiple choice). Avoid trick questions.',
            QuestionnaireKind::Survey => 'You are a thoughtful researcher writing survey questions. Use neutral, non-leading wording. Mix question types to keep respondents engaged.',
            QuestionnaireKind::Poll => 'You are writing live audience-poll questions. Keep them short, fun, and answerable in seconds.',
            QuestionnaireKind::Form => 'You are designing a form. Write fields that gather only the information needed; mark required fields appropriately.',
        };
    }

    protected function buildPrompt(QuestionnaireKind $kind, string $topic, int $count): string
    {
        $topic = trim($topic);
        $kindLabel = $kind->label();

        $hint = match ($kind) {
            QuestionnaireKind::Assessment => "Most questions should be 'single_choice' with 3-4 plausible options. Use 'short_text' or 'long_text' sparingly for opinion or explain-your-reasoning questions.",
            QuestionnaireKind::Survey => "Mix 'single_choice', 'multi_choice', 'likert', 'nps' and a few text fields.",
            QuestionnaireKind::Poll => "Use 'single_choice' only — polls need fast, clear voting.",
            QuestionnaireKind::Form => "Use 'short_text', 'long_text', 'date' and 'single_choice' for dropdowns.",
        };

        return <<<PROMPT
Generate exactly {$count} questions for a {$kindLabel} on the topic:

"{$topic}"

{$hint}

For choice-type questions, include 2-5 options. For assessments only, mark
the correct option(s) with is_correct=true and give them a positive score.
For non-assessment kinds, leave is_correct=false and score=0.
PROMPT;
    }

    protected function responseSchema(): ObjectSchema
    {
        $optionSchema = new ObjectSchema(
            name: 'option',
            description: 'A choice for a multiple-choice question.',
            properties: [
                new StringSchema('label', 'Display text shown to the respondent.'),
                new StringSchema('value', 'Stored value (kebab-case, machine-friendly).'),
                new BooleanSchema('is_correct', 'For assessments only — whether selecting this option is part of the correct answer.'),
                new NumberSchema('score', 'Points awarded for picking this option in a graded assessment. 0 for non-assessments.'),
            ],
            requiredFields: ['label', 'value', 'is_correct', 'score'],
        );

        $questionSchema = new ObjectSchema(
            name: 'question',
            description: 'A single question definition.',
            properties: [
                new StringSchema('title', 'The question text shown to the respondent.'),
                new StringSchema('helper', 'Optional clarifying sub-text or context. Empty string if not needed.'),
                new EnumSchema(
                    name: 'type',
                    description: 'Which input type this question uses.',
                    options: array_map(fn (QuestionType $t) => $t->value, [
                        QuestionType::SingleChoice,
                        QuestionType::MultiChoice,
                        QuestionType::Likert,
                        QuestionType::Nps,
                        QuestionType::ShortText,
                        QuestionType::LongText,
                        QuestionType::Rating,
                        QuestionType::Date,
                    ]),
                ),
                new BooleanSchema('required', 'Whether the respondent must answer.'),
                new NumberSchema('difficulty', 'Difficulty from 1 (easiest) to 5 (hardest).'),
                new ArraySchema(
                    name: 'options',
                    description: 'Choices for choice-type questions. Empty for text/likert/nps/rating/date.',
                    items: $optionSchema,
                ),
            ],
            requiredFields: ['title', 'type', 'required', 'difficulty', 'options'],
        );

        return new ObjectSchema(
            name: 'questions_response',
            description: 'A list of generated questions.',
            properties: [
                new ArraySchema(
                    name: 'questions',
                    description: 'Generated questions in display order.',
                    items: $questionSchema,
                ),
            ],
            requiredFields: ['questions'],
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, Question>
     */
    protected function persist(Questionnaire $questionnaire, array $items): array
    {
        $position = ((int) $questionnaire->questions()->max('position'));
        $created = [];

        foreach ($items as $item) {
            $type = $this->parseType($item['type'] ?? null);
            if (! $type) {
                continue;
            }

            $position++;

            $question = Question::create([
                'questionnaire_id' => $questionnaire->id,
                'type' => $type,
                'title' => $this->str($item['title'] ?? '', 1000) ?: 'Untitled question',
                'helper' => $this->str($item['helper'] ?? '', 1000) ?: null,
                'required' => (bool) ($item['required'] ?? false),
                'position' => $position,
                'meta' => ['difficulty' => min(5, max(1, (int) ($item['difficulty'] ?? 3)))],
            ]);

            if ($type->hasOptions()) {
                $optionPosition = 0;
                foreach ($item['options'] ?? [] as $opt) {
                    $optionPosition++;
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'label' => $this->str($opt['label'] ?? '', 500) ?: 'Option',
                        'value' => $this->str($opt['value'] ?? '', 100) ?: 'option-'.$optionPosition,
                        'is_correct' => $questionnaire->kind->isGraded() ? (bool) ($opt['is_correct'] ?? false) : false,
                        'score' => $questionnaire->kind->isGraded() ? (float) ($opt['score'] ?? 0) : 0,
                        'position' => $optionPosition,
                    ]);
                }
            }

            $created[] = $question->fresh('options');
        }

        return $created;
    }

    protected function parseType(?string $value): ?QuestionType
    {
        if (! is_string($value)) {
            return null;
        }

        return QuestionType::tryFrom($value);
    }

    protected function str(mixed $value, int $max): string
    {
        $s = is_string($value) ? trim($value) : '';

        return mb_substr($s, 0, $max);
    }
}
