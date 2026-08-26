<?php

namespace App\Services\AI;

use App\Enums\AiUsageKind;
use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseAnswer;
use Prism\Prism\Schema\BooleanSchema;
use Prism\Prism\Schema\NumberSchema;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;

/**
 * Grades the open-ended (text) answers in a Response with a rubric prompt.
 * Updates each ResponseAnswer in place and bumps the parent Response.score
 * with the awarded points.
 *
 * Auto-gradable types are NOT touched here — those were already scored by
 * the deterministic Scoring service at submit time.
 */
class Grader
{
    public function __construct(protected Brain $brain) {}

    public function gradeResponse(Response $response): void
    {
        // Only assessments need grading; nothing to do for surveys / polls / forms.
        if (! $response->questionnaire->kind->isGraded()) {
            return;
        }

        $openEndedAnswers = $response
            ->answers()
            ->whereHas('question', fn ($q) => $q->whereIn('type', ['short_text', 'long_text']))
            ->with('question')
            ->get();

        if ($openEndedAnswers->isEmpty()) {
            return;
        }

        $awardedTotal = 0.0;
        $maxTotal = 0.0;

        foreach ($openEndedAnswers as $answer) {
            $maxPoints = $this->maxPointsFor($answer->question);
            $maxTotal += $maxPoints;

            if ($maxPoints <= 0) {
                continue; // No rubric weight set — skip silently.
            }

            $result = $this->gradeOne($answer, $maxPoints);
            if ($result === null) {
                continue;
            }

            $awarded = max(0.0, min($maxPoints, (float) ($result['score'] ?? 0)));
            // Trust the AI's explicit is_correct if it returned one, else
            // fall back to a half-points threshold.
            $isCorrect = array_key_exists('is_correct', $result)
                ? (bool) $result['is_correct']
                : ($awarded >= $maxPoints * 0.5);

            $answer->forceFill([
                'is_correct' => $isCorrect,
                'score' => $awarded,
            ])->save();

            $awardedTotal += $awarded;
        }

        if ($maxTotal === 0.0) {
            return;
        }

        // Add the AI-graded portion onto whatever Scoring already wrote at
        // submit. Response.max_score must include the open-ended max even
        // though Question::maxScore() returns 0 for those types.
        $response->forceFill([
            'score' => (float) $response->score + $awardedTotal,
            'max_score' => (float) $response->max_score + $maxTotal,
        ])->save();
    }

    protected function maxPointsFor(Question $q): float
    {
        $configured = $q->meta['max_points'] ?? null;
        if (is_numeric($configured)) {
            return (float) $configured;
        }

        // Sensible default so authors get useful grading without opting in.
        return 1.0;
    }

    /**
     * @return array{score: float, feedback: string}|null
     */
    protected function gradeOne(ResponseAnswer $answer, float $maxPoints): ?array
    {
        $question = $answer->question;
        $rubric = $question->meta['rubric'] ?? $question->helper ?? '';
        $userAnswer = $this->extractText($answer->value);

        if (trim($userAnswer) === '') {
            return ['score' => 0, 'feedback' => 'No answer given.'];
        }

        $prompt = <<<PROMPT
Question: {$question->title}

Rubric / what a good answer covers:
{$rubric}

Maximum points: {$maxPoints}

Student answer:
{$userAnswer}

Score the student's answer from 0 to {$maxPoints}. Be fair but honest:
- {$maxPoints} = fully correct, complete, on-topic
- around half = partially correct or missing key ideas
- 0 = irrelevant, blank, or wrong
Return the numeric score and a one-sentence feedback for the student.
PROMPT;

        $structured = $this->brain->structured(
            kind: AiUsageKind::GradeAnswer,
            prompt: $prompt,
            schema: $this->responseSchema($maxPoints),
            system: 'You are a fair, encouraging grader. Score strictly to the rubric. Never invent facts about the student.',
            workspace: $answer->workspace,
            userId: null,
            meta: [
                'response_id' => $answer->response_id,
                'question_id' => $answer->question_id,
            ],
        );

        if (! is_array($structured) || ! isset($structured['score'])) {
            return null;
        }

        $out = [
            'score' => (float) $structured['score'],
            'feedback' => (string) ($structured['feedback'] ?? ''),
        ];
        if (array_key_exists('is_correct', $structured)) {
            $out['is_correct'] = (bool) $structured['is_correct'];
        }

        return $out;
    }

    protected function responseSchema(float $maxPoints): ObjectSchema
    {
        return new ObjectSchema(
            name: 'graded_answer',
            description: 'AI grade for an open-ended answer.',
            properties: [
                new NumberSchema('score', "Awarded points, between 0 and {$maxPoints} inclusive."),
                new StringSchema('feedback', 'One-sentence feedback for the student.'),
                new BooleanSchema('is_correct', 'Whether the answer is essentially correct.'),
            ],
            requiredFields: ['score', 'feedback'],
        );
    }

    protected function extractText(mixed $value): string
    {
        if (is_array($value)) {
            return (string) ($value[0] ?? '');
        }

        return (string) $value;
    }
}
