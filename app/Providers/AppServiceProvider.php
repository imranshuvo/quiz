<?php

namespace App\Providers;

use App\Events\ResponseSubmitted;
use App\Listeners\CreatePersonalWorkspace;
use App\Listeners\DispatchWebhooks;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Auth\Events\Registered;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Spatie\Activitylog\Models\Activity;

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
        Event::listen(ResponseSubmitted::class, DispatchWebhooks::class);

        Activity::creating(function (Activity $activity): void {
            $subject = $activity->subject;
            $workspaceId = $subject instanceof Workspace
                ? $subject->getKey()
                : $subject?->getAttribute('workspace_id');

            if ($workspaceId) {
                $activity->properties = $activity->properties->put('workspace_id', (int) $workspaceId);
            }
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120)->by((string) ($request->user()?->id ?? $request->ip()));
        });

        RateLimiter::for('public-submissions', function (Request $request) {
            return Limit::perMinute(20)->by($request->ip().'|'.(string) $request->route('slug'));
        });
    }
}
