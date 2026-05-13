<?php

namespace App\Livewire\Questionnaires\Responses;

use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public Questionnaire $questionnaire;

    public string $statusFilter = 'all';

    public function mount(Questionnaire $questionnaire): void
    {
        $current = app(Tenancy::class)->current();
        abort_unless($current && $questionnaire->workspace_id === $current->id, 404);

        $this->questionnaire = $questionnaire;
    }

    public function setStatus(string $status): void
    {
        $this->statusFilter = in_array($status, ['all', 'submitted', 'in_progress'], true) ? $status : 'all';
        $this->resetPage();
    }

    public function render(): View
    {
        $query = $this->questionnaire->responses()->latest('id');

        if ($this->statusFilter === 'submitted') {
            $query->where('status', ResponseStatus::Submitted);
        } elseif ($this->statusFilter === 'in_progress') {
            $query->where('status', ResponseStatus::InProgress);
        }

        $responses = $query->paginate(25);

        return view('livewire.questionnaires.responses.index', [
            'responses' => $responses,
            'statusCounts' => [
                'all' => $this->questionnaire->responses()->count(),
                'submitted' => $this->questionnaire->responses()->where('status', ResponseStatus::Submitted)->count(),
                'in_progress' => $this->questionnaire->responses()->where('status', ResponseStatus::InProgress)->count(),
            ],
        ]);
    }
}
