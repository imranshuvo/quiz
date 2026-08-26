<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionOptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'value' => $this->value,
            'is_correct' => (bool) $this->is_correct,
            'score' => (float) $this->score,
            'position' => $this->position,
        ];
    }
}
