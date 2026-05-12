<?php

namespace App\Providers;

use App\Listeners\CreatePersonalWorkspace;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Tenancy::class);
    }

    public function boot(): void
    {
        // Workspace is the Cashier billable — subscriptions belong to a
        // workspace, not a user, so seats and metered AI usage roll up
        // correctly per organization.
        Cashier::useCustomerModel(Workspace::class);

        Event::listen(Registered::class, CreatePersonalWorkspace::class);
    }
}
