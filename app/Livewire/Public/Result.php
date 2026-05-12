<?php

namespace App\Livewire\Public;

use App\Enums\QuestionnaireKind;
use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.public')]
class Result extends Component
{
    public string $slug = '';

    public int $responseId = 0;

    public int $workspaceId = 0;

    public function mount(string $slug, int $response): void
    {
        $q = Questionnaire::withoutWorkspaceScope()
            ->where('slug', $slug)
            ->firstOrFail();

        $this->bootTenancy($q->workspace_id);

        $resp = Response::query()->findOrFail($response);
        abort_unless(
            $resp->questionnaire_id === $q->id && $resp->status === ResponseStatus::Submitted,
            404,
        );

        $this->slug = $slug;
        $this->responseId = $resp->id;
        $this->workspaceId = $q->workspace_id;
    }

    public function hydrate(): void
    {
        if ($this->workspaceId > 0) {
            $this->bootTenancy($this->workspaceId);
        }
    }

    protected function bootTenancy(int $workspaceId): void
    {
        $workspace = Workspace::find($workspaceId);
        if ($workspace) {
            app(Tenancy::class)->setCurrent($workspace);
        }
    }

    public function render(): View
    {
        $response = Response::query()
            ->with(['questionnaire', 'answers.question.options'])
            ->findOrFail($this->responseId);

        $questionnaire = $response->questionnaire;
        $isGraded = $questionnaire->kind === QuestionnaireKind::Assessment;

        $breakdown = $isGraded
            ? $response->answers->map(function ($a) {
                $opts = $a->question->options;
                $correct = $opts->where('is_correct', true)->pluck('label')->all();
                return [
                    'question' => $a->question->title,
                    'is_correct' => $a->is_correct,
                    'score' => (float) $a->score,
                    'max' => $a->question->maxScore(),
                    'correct_answers' => $correct,
                ];
            })
            : collect();

        return view('livewire.public.result', [
            'questionnaire' => $questionnaire,
            'response' => $response,
            'isGraded' => $isGraded,
            'percentage' => $response->percentage(),
            'breakdown' => $breakdown,
        ]);
    }
}
