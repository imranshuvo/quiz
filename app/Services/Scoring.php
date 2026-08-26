<?php

namespace App\Services;

use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Response;

/**
 * Computes scores for a Response. Only auto-gradable types contribute to the
 * total — open-ended types (short_text, long_text) are scored later by the
 * AI grader (Phase 5) and may bump the score after the fact.
 *
 * Scoring rules per type:
 *   single_choice  → option's `score` if its value matches the answer, else 0.
 *   multi_choice   → all-or-nothing by default: full sum of correct option
 *                    scores if the answer set matches the correct set exactly,
 *                    otherwise 0. (Partial-credit mode is a Phase 5+ option
 *                    flag we'll thread through `question.meta` later.)
 */
class Scoring
{
    /** Score one answer in isolation. Returns [is_correct, awarded_score]. */
    public function scoreAnswer(Question $question, mixed $value): array
    {
        if (! $question->type->isAutoGradable()) {
            return [null, null];
        }

        $options = $question->options()->get();
        $correctValues = $options->where('is_correct', true)->pluck('value')->all();
        $maxFromCorrect = (float) $options->where('is_correct', true)->sum('score');

        $submitted = $this->normaliseToArray($value);

        return match ($question->type) {
            QuestionType::SingleChoice => $this->scoreSingleChoice($options, $submitted, $maxFromCorrect),
            QuestionType::MultiChoice => $this->scoreMultiChoice($correctValues, $submitted, $maxFromCorrect),
            default => [null, null],
        };
    }

    /** Compute and persist the total score on a Response. */
    public function scoreResponse(Response $response): void
    {
        $questionnaire = $response->questionnaire;
        if (! $questionnaire->kind->isGraded()) {
            // Surveys / polls / forms aren't graded.
            $response->forceFill([
                'score' => null,
                'max_score' => null,
            ])->save();

            return;
        }

        $questions = $questionnaire->questions()->with('options')->get();
        $maxScore = 0.0;
        $score = 0.0;

        foreach ($questions as $question) {
            $maxScore += $question->maxScore();

            $answer = $response->answers()->where('question_id', $question->id)->first();
            if (! $answer) {
                continue;
            }

            [$isCorrect, $awarded] = $this->scoreAnswer($question, $answer->value);
            $answer->forceFill([
                'is_correct' => $isCorrect,
                'score' => $awarded,
            ])->save();

            $score += (float) ($awarded ?? 0);
        }

        $response->forceFill([
            'score' => $score,
            'max_score' => $maxScore,
        ])->save();
    }

    protected function scoreSingleChoice($options, array $submitted, float $maxFromCorrect): array
    {
        if (empty($submitted)) {
            return [false, 0.0];
        }

        $picked = $options->firstWhere('value', $submitted[0]);
        if (! $picked) {
            return [false, 0.0];
        }

        if ($picked->is_correct) {
            return [true, (float) $picked->score];
        }

        // A wrong pick on a graded single-choice could carry a negative
        // score for penalty schemes — return its raw score.
        return [false, (float) $picked->score];
    }

    protected function scoreMultiChoice(array $correctValues, array $submitted, float $maxFromCorrect): array
    {
        sort($correctValues);
        sort($submitted);

        $exactMatch = $correctValues === $submitted;

        return [$exactMatch, $exactMatch ? $maxFromCorrect : 0.0];
    }

    protected function normaliseToArray(mixed $value): array
    {
        if ($value === null) {
            return [];
        }
        if (is_array($value)) {
            // Filter out empty strings/null in case of stale UI state.
            return array_values(array_filter($value, fn ($v) => $v !== null && $v !== ''));
        }

        return [$value];
    }
}
