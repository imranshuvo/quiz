<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebhookEndpoint>
 */
class WebhookEndpointFactory extends Factory
{
    protected $model = WebhookEndpoint::class;

    public function definition(): array
    {
        $current = app(Tenancy::class)->current();

        return [
            // Workspace-wide endpoint by default; tests can override.
            'workspace_id' => $current?->id ?? Workspace::factory(),
            'questionnaire_id' => null,
            'name' => fake()->unique()->words(2, true),
            'url' => fake()->url(),
            'active' => true,
        ];
    }

    public function forQuestionnaire(Questionnaire $q): self
    {
        return $this->state([
            'workspace_id' => $q->workspace_id,
            'questionnaire_id' => $q->id,
        ]);
    }
}
