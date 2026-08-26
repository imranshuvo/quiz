<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'questionnaire_id' => $this->questionnaire_id,
            'respondent_email' => $this->respondent_email,
            'anonymous' => $this->isAnonymous(),
            'status' => $this->status->value,
            'score' => $this->score === null ? null : (float) $this->score,
            'max_score' => $this->max_score === null ? null : (float) $this->max_score,
            'percentage' => $this->percentage(),
            'started_at' => $this->started_at?->toISOString(),
            'submitted_at' => $this->submitted_at?->toISOString(),
            'answers' => $this->whenLoaded('answers', fn () => $this->answers->map(fn ($answer) => [
                'id' => $answer->id,
                'question_id' => $answer->question_id,
                'value' => $answer->value,
                'is_correct' => $answer->is_correct,
                'score' => $answer->score === null ? null : (float) $answer->score,
                'answered_at' => $answer->answered_at?->toISOString(),
            ])),
        ];
    }
}
