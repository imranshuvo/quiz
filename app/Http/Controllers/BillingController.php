<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use App\Services\Tenancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Send the workspace owner to a Stripe Checkout session for the given plan.
     */
    public function checkout(Request $request, string $plan, Tenancy $tenancy): RedirectResponse
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless($request->user()->roleIn($workspace)?->canManageBilling(), 403);

        $planEnum = Plan::tryFrom($plan);
        abort_unless($planEnum && $planEnum->isPaid(), 404);

        $priceId = $planEnum->stripePrice();
        abort_unless($priceId, 422, 'No Stripe price configured for this plan.');

        $session = $workspace
            ->newSubscription(config('billing.subscription_name', 'default'), $priceId)
            ->trialDays((int) config('billing.trial_days', 0))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('settings.billing').'?checkout=success',
                'cancel_url' => route('settings.billing').'?checkout=cancelled',
                'customer_update' => ['address' => 'auto', 'name' => 'auto'],
                'billing_address_collection' => 'required',
                'tax_id_collection' => ['enabled' => true],
                'automatic_tax' => ['enabled' => (bool) config('billing.stripe_tax_enabled', true)],
            ]);

        return redirect($session->url);
    }

    /** Drop the user into the Stripe Customer Portal to change/cancel/update card. */
    public function portal(Request $request, Tenancy $tenancy): RedirectResponse
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless($request->user()->roleIn($workspace)?->canManageBilling(), 403);

        return $workspace->redirectToBillingPortal(route('settings.billing'));
    }
}
