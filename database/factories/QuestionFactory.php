<?php

namespace Database\Factories;

use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            // Lazy: the closures only run for attributes the caller didn't
            // override via state(). forQuestionnaire() sets both keys, so
            // neither closure fires.
            'questionnaire_id' => fn () => Questionnaire::factory()->create()->id,
            'workspace_id' => fn (array $attrs) => Questionnaire::withoutWorkspaceScope()
                ->find($attrs['questionnaire_id'])
                ->workspace_id,
            'type' => QuestionType::SingleChoice,
            'title' => fake()->sentence().'?',
            'helper' => null,
            'required' => true,
            'position' => 0,
            'meta' => [],
            'branching' => null,
        ];
    }

    public function forQuestionnaire(Questionnaire $questionnaire): self
    {
        return $this->state([
            'workspace_id' => $questionnaire->workspace_id,
            'questionnaire_id' => $questionnaire->id,
        ]);
    }

    public function ofType(QuestionType $type): self
    {
        return $this->state(['type' => $type]);
    }

    public function shortText(): self
    {
        return $this->ofType(QuestionType::ShortText);
    }

    public function multiChoice(): self
    {
        return $this->ofType(QuestionType::MultiChoice);
    }
}
