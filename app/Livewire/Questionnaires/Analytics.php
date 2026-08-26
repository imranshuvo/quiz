<?php

namespace App\Livewire\Questionnaires;

use App\Models\Questionnaire;
use App\Services\AI\Insights;
use App\Services\Reports\Aggregator;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.app')]
class Analytics extends Component
{
    public Questionnaire $questionnaire;

    public bool $analyzing = false;

    public ?string $analyzeError = null;

    public function mount(Questionnaire $questionnaire): void
    {
        $current = app(Tenancy::class)->current();
        abort_unless($current && $questionnaire->workspace_id === $current->id, 404);
        $this->questionnaire = $questionnaire;
    }

    public function runInsights(Insights $insights): void
    {
        if (! auth()->user()->roleIn(app(Tenancy::class)->current())?->canEditContent()) {
            abort(403);
        }

        $this->analyzing = true;
        $this->analyzeError = null;

        try {
            $insights->analyzeQuestionnaire($this->questionnaire);
        } catch (Throwable $e) {
            $this->analyzeError = 'Insights failed: '.$e->getMessage();
            $this->analyzing = false;

            return;
        }

        $this->analyzing = false;
        $this->questionnaire->refresh();
    }

    public function render(Aggregator $agg): View
    {
        $summary = $agg->summary($this->questionnaire);
        $histogram = $agg->scoreHistogram($this->questionnaire);
        $nps = $agg->nps($this->questionnaire);
        $perQuestion = $agg->perQuestion($this->questionnaire);
        $insights = $this->questionnaire->settings['insights'] ?? null;

        return view('livewire.questionnaires.analytics', [
            'summary' => $summary,
            'histogram' => $histogram,
            'nps' => $nps,
            'perQuestion' => $perQuestion,
            'insights' => $insights,
        ]);
    }
}
