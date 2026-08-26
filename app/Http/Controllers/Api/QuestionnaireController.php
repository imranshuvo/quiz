<?php

namespace App\Http\Controllers\Api;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Http\Resources\QuestionnaireResource;
use App\Models\Questionnaire;
use App\Services\Billing\Limits;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class QuestionnaireController extends ApiController
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'kind' => ['nullable', Rule::enum(QuestionnaireKind::class)],
            'status' => ['nullable', Rule::enum(QuestionnaireStatus::class)],
            'search' => ['nullable', 'string', 'max:100'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $items = Questionnaire::query()
            ->withCount(['questions', 'responses'])
            ->when($validated['kind'] ?? null, fn ($query, $kind) => $query->where('kind', $kind))
            ->when($validated['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($validated['search'] ?? null, fn ($query, $search) => $query->where('title', 'like', '%'.$search.'%'))
            ->latest()
            ->paginate($validated['per_page'] ?? 25);

        return QuestionnaireResource::collection($items);
    }

    public function store(Request $request, Limits $limits): QuestionnaireResource
    {
        $this->authorizeContentWrite($request);
        abort_unless($limits->canCreateQuestionnaire($this->workspace($request)), 422, 'Questionnaire plan limit reached.');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'kind' => ['required', Rule::enum(QuestionnaireKind::class)],
            'settings' => ['sometimes', 'array'],
        ]);

        $questionnaire = Questionnaire::create([
            ...$validated,
            'creator_id' => $request->user()->id,
            'status' => QuestionnaireStatus::Draft,
        ]);

        return new QuestionnaireResource($questionnaire->loadCount(['questions', 'responses']));
    }

    public function show(Questionnaire $questionnaire): QuestionnaireResource
    {
        return new QuestionnaireResource($questionnaire->load(['questions.options'])->loadCount(['questions', 'responses']));
    }

    public function update(Request $request, Questionnaire $questionnaire): QuestionnaireResource
    {
        $this->authorizeContentWrite($request);

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:5000'],
            'kind' => ['sometimes', Rule::enum(QuestionnaireKind::class)],
            'status' => ['sometimes', Rule::enum(QuestionnaireStatus::class)],
            'settings' => ['sometimes', 'array'],
        ]);

        if (($validated['status'] ?? null) === QuestionnaireStatus::Published->value) {
            abort_if($questionnaire->questions()->count() === 0, 422, 'Add at least one question before publishing.');
            $validated['published_at'] = $questionnaire->published_at ?? now();
        }

        $questionnaire->update($validated);

        return new QuestionnaireResource($questionnaire->refresh()->load(['questions.options'])->loadCount(['questions', 'responses']));
    }

    public function destroy(Request $request, Questionnaire $questionnaire): Response
    {
        $this->authorizeContentWrite($request);
        $questionnaire->delete();

        return response()->noContent();
    }
}
