<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Response;

/**
 * Interprets a question's `branching` JSON to choose the next step in a
 * questionnaire. The shape is intentionally small and human-editable:
 *
 *   [
 *     {
 *       "when": { "operator": "in", "value": ["yes", "maybe"] },
 *       "action": { "type": "skip_to", "question_id": 42 }
 *     },
 *     {
 *       "when": { "operator": "equals", "value": "no" },
 *       "action": { "type": "end" }
 *     }
 *   ]
 *
 * The first matching rule wins. If nothing matches (or the column is null),
 * we fall through to the next question by `position`.
 *
 * Operators supported: equals, not_equals, in, not_in, gte, lte, contains, any.
 *  - "any" matches when any value was submitted (non-empty answer)
 */
class Branching
{
    public function __construct(protected Scoring $scoring) {}

    /**
     * Resolve the next question id (or null = end of questionnaire) given:
     *   $current  → the question just answered
     *   $value    → the answer value (scalar, array, or null)
     *   $response → the in-progress Response (so we can avoid infinite loops)
     */
    public function nextQuestionId(Question $current, mixed $value, Response $response): ?int
    {
        $rules = $current->branching ?? [];

        foreach ($rules as $rule) {
            if ($this->matches($rule['when'] ?? [], $value)) {
                return $this->resolveAction($rule['action'] ?? [], $current);
            }
        }

        if (($current->questionnaire->settings['adaptive_difficulty'] ?? false)
            && $current->questionnaire->kind->isGraded()
        ) {
            return $this->adaptiveNext($current, $value, $response);
        }

        return $this->fallthrough($current);
    }

    protected function adaptiveNext(Question $current, mixed $value, Response $response): ?int
    {
        $answeredIds = array_unique([...$response->answers()->pluck('question_id')->all(), $current->id]);
        $candidates = Question::where('questionnaire_id', $current->questionnaire_id)
            ->whereNotIn('id', $answeredIds)
            ->get();

        if ($candidates->isEmpty()) {
            return null;
        }

        $difficulty = min(5, max(1, (int) ($current->meta['difficulty'] ?? 3)));
        [$correct] = $this->scoring->scoreAnswer($current, $value);
        $target = match ($correct) {
            true => min(5, $difficulty + 1),
            false => max(1, $difficulty - 1),
            default => $difficulty,
        };

        return $candidates
            ->sortBy(fn (Question $question) => [
                abs(((int) ($question->meta['difficulty'] ?? 3)) - $target),
                $question->position,
            ])
            ->first()?->id;
    }

    protected function matches(array $when, mixed $value): bool
    {
        $operator = $when['operator'] ?? 'equals';
        $expected = $when['value'] ?? null;
        $actual = $this->scalar($value);

        return match ($operator) {
            'equals' => $actual === $this->scalar($expected),
            'not_equals' => $actual !== $this->scalar($expected),
            'in' => is_array($expected) && in_array($actual, $expected, true),
            'not_in' => is_array($expected) && ! in_array($actual, $expected, true),
            'gte' => is_numeric($actual) && is_numeric($expected) && (float) $actual >= (float) $expected,
            'lte' => is_numeric($actual) && is_numeric($expected) && (float) $actual <= (float) $expected,
            'contains' => is_array($value) && in_array($expected, $value, true),
            'any' => $this->isNonEmpty($value),
            default => false,
        };
    }

    protected function resolveAction(array $action, Question $current): ?int
    {
        $type = $action['type'] ?? 'continue';

        return match ($type) {
            'end' => null,
            'skip_to' => isset($action['question_id']) ? (int) $action['question_id'] : $this->fallthrough($current),
            default => $this->fallthrough($current),
        };
    }

    protected function fallthrough(Question $current): ?int
    {
        $next = Question::where('questionnaire_id', $current->questionnaire_id)
            ->where('position', '>', $current->position)
            ->orderBy('position')
            ->first();

        return $next?->id;
    }

    protected function scalar(mixed $value): mixed
    {
        if (is_array($value)) {
            return $value[0] ?? null;
        }

        return $value;
    }

    protected function isNonEmpty(mixed $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }
        if (is_array($value)) {
            return count(array_filter($value, fn ($v) => $v !== null && $v !== '')) > 0;
        }

        return true;
    }
}
