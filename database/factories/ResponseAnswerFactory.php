<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ResponseAnswer>
 */
class ResponseAnswerFactory extends Factory
{
    protected $model = ResponseAnswer::class;

    public function definition(): array
    {
        return [
            // If neither response_id nor question_id is provided, create a
            // shared questionnaire so they line up correctly.
            'response_id' => fn () => Response::factory()->create()->id,
            'question_id' => fn (array $attrs) => Question::factory()
                ->forQuestionnaire(
                    Response::withoutWorkspaceScope()->find($attrs['response_id'])->questionnaire
                )
                ->create()->id,
            'workspace_id' => fn (array $attrs) => Response::withoutWorkspaceScope()
                ->find($attrs['response_id'])
                ->workspace_id,
            'value' => ['sample'],
            'answered_at' => now(),
        ];
    }

    public function pair(Response $response, Question $question): self
    {
        return $this->state([
            'workspace_id' => $response->workspace_id,
            'response_id' => $response->id,
            'question_id' => $question->id,
        ]);
    }
}
