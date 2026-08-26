<?php

namespace App\Livewire\Settings;

use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

#[Layout('components.layouts.app')]
class AuditLog extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $workspace = app(Tenancy::class)->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canManageMembers(), 403);
    }

    public function render(Tenancy $tenancy): View
    {
        $activities = Activity::query()
            ->where('properties->workspace_id', $tenancy->current()->id)
            ->with(['causer', 'subject'])
            ->latest('id')
            ->paginate(30);

        return view('livewire.settings.audit-log', compact('activities'));
    }
}
