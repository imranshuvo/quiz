<?php

namespace App\Livewire\Public;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Models\Questionnaire;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.public')]
class Poll extends Component
{
    public string $slug = '';

    public int $workspaceId = 0;

    public int $questionnaireId = 0;

    public function mount(string $slug): void
    {
        $q = Questionnaire::withoutWorkspaceScope()
            ->where('slug', $slug)
            ->firstOrFail();

        abort_unless(
            $q->status === QuestionnaireStatus::Published && $q->kind === QuestionnaireKind::Poll,
            404,
        );

        $this->bootTenancy($q->workspace_id);
        $this->slug = $slug;
        $this->workspaceId = $q->workspace_id;
        $this->questionnaireId = $q->id;
    }

    public function hydrate(): void
    {
        if ($this->workspaceId > 0) {
            $this->bootTenancy($this->workspaceId);
        }
    }

    /** Re-render when a vote arrives. The actual data is recomputed in render(). */
    #[On('echo:polls.{slug},vote-recorded')]
    public function onVoteRecorded(): void
    {
        // Trigger re-render. No state change needed — render() re-queries.
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
        $q = Questionnaire::withoutWorkspaceScope()->findOrFail($this->questionnaireId);
        $questions = $q->questions()->with('options')->get();

        // For each question, compute tallies: option_value => count.
        $tallies = $this->computeTallies($questions);

        return view('livewire.public.poll', [
            'questionnaire' => $q,
            'questions' => $questions,
            'tallies' => $tallies,
            'totalVoters' => $q->responses()->count(),
        ]);
    }

    protected function computeTallies(Collection $questions): array
    {
        $out = [];

        foreach ($questions as $question) {
            $tallies = [];
            $total = 0;

            $answers = $question->answers()->get(['value']);
            foreach ($answers as $a) {
                $values = is_array($a->value) ? $a->value : [$a->value];
                foreach ($values as $v) {
                    if ($v === null || $v === '') {
                        continue;
                    }
                    $tallies[$v] = ($tallies[$v] ?? 0) + 1;
                    $total++;
                }
            }

            $out[$question->id] = [
                'tallies' => $tallies,
                'total' => $total,
            ];
        }

        return $out;
    }
}
