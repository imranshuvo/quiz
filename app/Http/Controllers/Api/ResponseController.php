<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatus;
use App\Http\Resources\ResponseResource;
use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class ResponseController extends ApiController
{
    public function index(Request $request, Questionnaire $questionnaire): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'status' => ['nullable', Rule::enum(ResponseStatus::class)],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $responses = $questionnaire->responses()
            ->when($validated['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest('id')
            ->paginate($validated['per_page'] ?? 25);

        return ResponseResource::collection($responses);
    }

    public function show(Questionnaire $questionnaire, Response $response): ResponseResource
    {
        abort_unless($response->questionnaire_id === $questionnaire->id, 404);

        return new ResponseResource($response->load('answers'));
    }
}
