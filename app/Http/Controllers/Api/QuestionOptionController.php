<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionOptionResource;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionOptionController extends ApiController
{
    public function store(Request $request, Questionnaire $questionnaire, Question $question): QuestionOptionResource
    {
        $this->authorizeContentWrite($request);
        $this->ensureNested($questionnaire, $question);
        abort_unless($question->type->hasOptions(), 422, 'This question type does not support options.');

        $validated = $this->validated($request);
        $option = $question->options()->create([
            ...$validated,
            'position' => $validated['position'] ?? (((int) $question->options()->max('position')) + 1),
        ]);

        return new QuestionOptionResource($option);
    }

    public function update(
        Request $request,
        Questionnaire $questionnaire,
        Question $question,
        QuestionOption $option,
    ): QuestionOptionResource {
        $this->authorizeContentWrite($request);
        $this->ensureNested($questionnaire, $question, $option);
        $option->update($this->validated($request, true));

        return new QuestionOptionResource($option->refresh());
    }

    public function destroy(
        Request $request,
        Questionnaire $questionnaire,
        Question $question,
        QuestionOption $option,
    ): Response {
        $this->authorizeContentWrite($request);
        $this->ensureNested($questionnaire, $question, $option);
        $option->delete();

        return response()->noContent();
    }

    private function validated(Request $request, bool $partial = false): array
    {
        $presence = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'label' => [$presence, 'string', 'max:500'],
            'value' => [$presence, 'string', 'max:255'],
            'is_correct' => ['sometimes', 'boolean'],
            'score' => ['sometimes', 'numeric', 'between:-99999,99999'],
            'position' => ['sometimes', 'integer', 'min:0'],
        ]);
    }

    private function ensureNested(
        Questionnaire $questionnaire,
        Question $question,
        ?QuestionOption $option = null,
    ): void {
        abort_unless($question->questionnaire_id === $questionnaire->id, 404);
        abort_unless(! $option || $option->question_id === $question->id, 404);
    }
}
