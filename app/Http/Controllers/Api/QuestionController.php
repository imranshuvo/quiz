<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionType;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class QuestionController extends ApiController
{
    public function store(Request $request, Questionnaire $questionnaire): QuestionResource
    {
        $this->authorizeContentWrite($request);
        $validated = $this->validated($request);

        $question = $questionnaire->questions()->create([
            ...$validated,
            'position' => $validated['position'] ?? (((int) $questionnaire->questions()->max('position')) + 1),
        ]);

        return new QuestionResource($question->load('options'));
    }

    public function update(Request $request, Questionnaire $questionnaire, Question $question): QuestionResource
    {
        $this->authorizeContentWrite($request);
        abort_unless($question->questionnaire_id === $questionnaire->id, 404);

        $question->update($this->validated($request, true));

        return new QuestionResource($question->refresh()->load('options'));
    }

    public function destroy(Request $request, Questionnaire $questionnaire, Question $question): Response
    {
        $this->authorizeContentWrite($request);
        abort_unless($question->questionnaire_id === $questionnaire->id, 404);
        $question->delete();

        return response()->noContent();
    }

    private function validated(Request $request, bool $partial = false): array
    {
        $presence = $partial ? 'sometimes' : 'required';

        return $request->validate([
            'type' => [$presence, Rule::enum(QuestionType::class)],
            'title' => [$presence, 'string', 'max:1000'],
            'helper' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'required' => ['sometimes', 'boolean'],
            'position' => ['sometimes', 'integer', 'min:0'],
            'meta' => ['sometimes', 'array'],
            'branching' => ['sometimes', 'array'],
        ]);
    }
}
