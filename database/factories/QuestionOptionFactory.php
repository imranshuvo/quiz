<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuestionOption>
 */
class QuestionOptionFactory extends Factory
{
    protected $model = QuestionOption::class;

    public function definition(): array
    {
        $label = fake()->words(3, true);

        return [
            'question_id' => fn () => Question::factory()->create()->id,
            'workspace_id' => fn (array $attrs) => Question::withoutWorkspaceScope()
                ->find($attrs['question_id'])
                ->workspace_id,
            'label' => $label,
            'value' => str()->slug($label),
            'is_correct' => false,
            'score' => 0,
            'position' => 0,
        ];
    }

    public function forQuestion(Question $question): self
    {
        return $this->state([
            'workspace_id' => $question->workspace_id,
            'question_id' => $question->id,
        ]);
    }

    public function correct(float $score = 1.0): self
    {
        return $this->state(['is_correct' => true, 'score' => $score]);
    }
}
