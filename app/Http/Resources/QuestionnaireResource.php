<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionnaireResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kind' => $this->kind->value,
            'status' => $this->status->value,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'public_url' => route('public.taker', $this->slug),
            'settings' => $this->settings ?? [],
            'published_at' => $this->published_at?->toISOString(),
            'questions_count' => $this->whenCounted('questions'),
            'responses_count' => $this->whenCounted('responses'),
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
