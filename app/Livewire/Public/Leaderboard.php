<?php

namespace App\Livewire\Public;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.public')]
class Leaderboard extends Component
{
    public string $slug = '';

    public int $questionnaireId = 0;

    public int $workspaceId = 0;

    public function mount(string $slug): void
    {
        $questionnaire = Questionnaire::withoutWorkspaceScope()->where('slug', $slug)->firstOrFail();
        abort_unless(
            $questionnaire->status === QuestionnaireStatus::Published
            && $questionnaire->kind === QuestionnaireKind::Assessment,
            404,
        );

        $this->slug = $slug;
        $this->questionnaireId = $questionnaire->id;
        $this->workspaceId = $questionnaire->workspace_id;
        $this->bootTenancy();
    }

    public function hydrate(): void
    {
        $this->bootTenancy();
    }

    #[On('echo:leaderboards.{slug},response-submitted')]
    public function refreshLeaderboard(): void {}

    public function render(): View
    {
        $questionnaire = Questionnaire::findOrFail($this->questionnaireId);
        $limit = min(100, max(5, (int) ($questionnaire->settings['leaderboard_limit'] ?? 20)));

        $leaders = $questionnaire->responses()
            ->where('status', ResponseStatus::Submitted)
            ->whereNotNull('score')
            ->where('max_score', '>', 0)
            ->with('respondent:id,name')
            ->get()
            ->sortByDesc(fn ($response) => [$response->percentage(), (float) $response->score, -$response->submitted_at->timestamp])
            ->take($limit)
            ->values();

        return view('livewire.public.leaderboard', compact('questionnaire', 'leaders'));
    }

    private function bootTenancy(): void
    {
        if ($workspace = Workspace::find($this->workspaceId)) {
            app(Tenancy::class)->setCurrent($workspace);
        }
    }
}
