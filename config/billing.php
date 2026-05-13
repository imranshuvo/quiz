<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Subscription plans
    |--------------------------------------------------------------------------
    |
    | One workspace = one billable subscription. The shape below is intentionally
    | flat so a future Filament admin or marketing page can read it directly.
    |
    | `stripe_price` maps a plan key to the live Stripe Price ID — read from env
    | so dev / staging / prod can use different prices. Free plan has no price.
    |
    | `limits` are enforced by App\Services\Billing\Limits. `null` means
    | "unlimited" for that limit. `0` means "feature disabled on this plan".
    |
    */

    'plans' => [
        'free' => [
            'name' => 'Free',
            'monthly_price_cents' => 0,
            'stripe_price' => null,
            'limits' => [
                'questionnaires' => 3,
                'responses_per_month' => 100,
                'ai_calls_per_month' => 20,
                'team_members' => 1,
                'webhooks' => 0,
            ],
        ],
        'pro' => [
            'name' => 'Pro',
            'monthly_price_cents' => 1900,
            'stripe_price' => env('STRIPE_PRICE_PRO'),
            'limits' => [
                'questionnaires' => 50,
                'responses_per_month' => 5000,
                'ai_calls_per_month' => 500,
                'team_members' => 5,
                'webhooks' => 10,
            ],
        ],
        'business' => [
            'name' => 'Business',
            'monthly_price_cents' => 7900,
            'stripe_price' => env('STRIPE_PRICE_BUSINESS'),
            'limits' => [
                'questionnaires' => null,
                'responses_per_month' => null,
                'ai_calls_per_month' => 5000,
                'team_members' => null,
                'webhooks' => null,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default subscription name (Cashier convention)
    |--------------------------------------------------------------------------
    |
    | Cashier supports multiple subscription types per billable; we only need
    | one. Centralised here so we don't drift between caller sites.
    |
    */
    'subscription_name' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Trial (in days)
    |--------------------------------------------------------------------------
    |
    | New Pro/Business subscriptions start with a trial. Zero disables it.
    |
    */
    'trial_days' => env('BILLING_TRIAL_DAYS', 14),

    /*
    |--------------------------------------------------------------------------
    | Stripe Tax & customer collection
    |--------------------------------------------------------------------------
    |
    | We're a Danish company → EU VAT applies. Stripe Tax handles the
    | calculation; we just toggle it on at checkout creation and tell Stripe
    | to collect the customer address.
    |
    */
    'stripe_tax_enabled' => env('STRIPE_TAX_ENABLED', true),

    'allow_promotion_codes' => env('STRIPE_ALLOW_PROMOTION_CODES', true),
];
