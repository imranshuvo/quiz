<?php

namespace App\Livewire;

use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public function render(Tenancy $tenancy): View
    {
        $workspace = $tenancy->current();

        if (! $workspace) {
            return view('livewire.dashboard', [
                'workspace' => null,
                'stats' => ['questionnaires' => 0, 'published' => 0, 'responses' => 0, 'completion_rate' => 0],
                'recentQuestionnaires' => collect(),
                'recentResponses' => collect(),
            ]);
        }

        $questionnaires = Questionnaire::query();
        $responses = Response::query();
        $responseCount = (clone $responses)->count();
        $submittedCount = (clone $responses)->where('status', ResponseStatus::Submitted)->count();

        return view('livewire.dashboard', [
            'workspace' => $workspace,
            'stats' => [
                'questionnaires' => (clone $questionnaires)->count(),
                'published' => (clone $questionnaires)->where('status', 'published')->count(),
                'responses' => $responseCount,
                'completion_rate' => $responseCount > 0 ? round(($submittedCount / $responseCount) * 100, 1) : 0,
            ],
            'recentQuestionnaires' => (clone $questionnaires)
                ->withCount('responses')
                ->latest('updated_at')
                ->limit(5)
                ->get(),
            'recentResponses' => (clone $responses)
                ->with('questionnaire:id,title')
                ->latest('id')
                ->limit(5)
                ->get(),
        ]);
    }
}
