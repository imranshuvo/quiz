<?php

namespace App\Livewire\Questionnaires\Responses;

use App\Models\Questionnaire;
use App\Models\Response;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Show extends Component
{
    public Questionnaire $questionnaire;

    public Response $response;

    public function mount(Questionnaire $questionnaire, Response $response): void
    {
        $current = app(Tenancy::class)->current();
        abort_unless($current && $questionnaire->workspace_id === $current->id, 404);
        abort_unless($response->questionnaire_id === $questionnaire->id, 404);

        $this->questionnaire = $questionnaire;
        $this->response = $response;
    }

    public function render(): View
    {
        $questions = $this->questionnaire->questions()->with('options')->orderBy('position')->get();
        $answersByQ = $this->response->answers()->get()->keyBy('question_id');

        return view('livewire.questionnaires.responses.show', [
            'questions' => $questions,
            'answersByQ' => $answersByQ,
        ]);
    }
}
