<?php

namespace Database\Factories;

use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Response>
 */
class ResponseFactory extends Factory
{
    protected $model = Response::class;

    public function definition(): array
    {
        return [
            'questionnaire_id' => fn () => Questionnaire::factory()->create()->id,
            'workspace_id' => fn (array $attrs) => Questionnaire::withoutWorkspaceScope()
                ->find($attrs['questionnaire_id'])
                ->workspace_id,
            'respondent_user_id' => null,
            'respondent_email' => fake()->safeEmail(),
            'session_token' => Str::random(48),
            'status' => ResponseStatus::InProgress,
            'started_at' => now(),
            'meta' => [],
        ];
    }

    public function forQuestionnaire(Questionnaire $questionnaire): self
    {
        return $this->state([
            'workspace_id' => $questionnaire->workspace_id,
            'questionnaire_id' => $questionnaire->id,
        ]);
    }

    public function submitted(): self
    {
        return $this->state([
            'status' => ResponseStatus::Submitted,
            'submitted_at' => now(),
        ]);
    }
}
