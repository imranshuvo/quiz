<?php

namespace Database\Factories;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Questionnaire>
 */
class QuestionnaireFactory extends Factory
{
    protected $model = Questionnaire::class;

    public function definition(): array
    {
        // Honor the current tenancy when set (typical in tests) so all
        // factory-created rows land in the same workspace and remain visible
        // through the global scope. Fall back to a new workspace otherwise.
        $current = app(Tenancy::class)->current();

        return [
            'workspace_id' => $current?->id ?? Workspace::factory(),
            'creator_id' => User::factory(),
            'kind' => QuestionnaireKind::Assessment,
            'status' => QuestionnaireStatus::Draft,
            'title' => fake()->catchPhrase(),
            'description' => fake()->optional()->sentence(),
            'settings' => [],
        ];
    }

    public function survey(): self
    {
        return $this->state(['kind' => QuestionnaireKind::Survey]);
    }

    public function poll(): self
    {
        return $this->state(['kind' => QuestionnaireKind::Poll]);
    }

    public function form(): self
    {
        return $this->state(['kind' => QuestionnaireKind::Form]);
    }

    public function published(): self
    {
        return $this->state([
            'status' => QuestionnaireStatus::Published,
            'published_at' => now(),
        ]);
    }
}
