<?php

namespace App\Livewire\Settings;

use App\Enums\Plan;
use App\Services\Billing\Limits;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Billing extends Component
{
    public function render(Limits $limits, Tenancy $tenancy): View
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);

        $currentPlan = $limits->planFor($workspace);
        $summary = $limits->summary($workspace);

        $sub = $workspace->subscription(config('billing.subscription_name', 'default'));

        $authRole = auth()->user()->roleIn($workspace);

        return view('livewire.settings.billing', [
            'workspace' => $workspace,
            'currentPlan' => $currentPlan,
            'plans' => Plan::cases(),
            'summary' => $summary,
            'subscription' => $sub,
            'canManageBilling' => $authRole?->canManageBilling() ?? false,
        ]);
    }
}
