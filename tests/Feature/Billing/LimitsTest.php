<?php

use App\Enums\Plan;
use App\Models\AiUsage;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;
use App\Services\Billing\Limits;
use App\Services\Tenancy;
use Laravel\Cashier\Subscription;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
    $this->limits = app(Limits::class);

    // Stable Stripe price IDs for the test environment so plan resolution
    // is deterministic across machines.
    config()->set('billing.plans.pro.stripe_price', 'price_test_pro');
    config()->set('billing.plans.business.stripe_price', 'price_test_business');
});

it('a workspace with no subscription is on the Free plan', function () {
    expect($this->limits->planFor($this->workspace))->toBe(Plan::Free);
});

it('an active Pro subscription resolves to the Pro plan', function () {
    $sub = Subscription::create([
        'workspace_id' => $this->workspace->id,
        'type' => 'default',
        'stripe_id' => 'sub_test_'.uniqid(),
        'stripe_status' => 'active',
        'stripe_price' => 'price_test_pro',
        'quantity' => 1,
    ]);

    expect($this->limits->planFor($this->workspace->fresh()))->toBe(Plan::Pro);
});

it('a cancelled-and-past-grace subscription falls back to Free', function () {
    Subscription::create([
        'workspace_id' => $this->workspace->id,
        'type' => 'default',
        'stripe_id' => 'sub_test_'.uniqid(),
        'stripe_status' => 'canceled',
        'stripe_price' => 'price_test_pro',
        'quantity' => 1,
        'ends_at' => now()->subDay(),
    ]);

    expect($this->limits->planFor($this->workspace->fresh()))->toBe(Plan::Free);
});

it('Free plan blocks the 4th questionnaire (limit 3)', function () {
    Questionnaire::factory()->count(3)->create(); // workspace_id auto-fills via tenancy

    expect($this->limits->canCreateQuestionnaire($this->workspace))->toBeFalse();
});

it('Free plan allows the 3rd questionnaire (limit 3)', function () {
    Questionnaire::factory()->count(2)->create();

    expect($this->limits->canCreateQuestionnaire($this->workspace))->toBeTrue();
});

it('Free plan blocks all webhooks (limit 0 = feature disabled)', function () {
    expect($this->limits->canAddWebhook($this->workspace))->toBeFalse();
});

it('Pro plan allows webhooks up to the limit', function () {
    Subscription::create([
        'workspace_id' => $this->workspace->id, 'type' => 'default',
        'stripe_id' => 'sub_test_'.uniqid(), 'stripe_status' => 'active',
        'stripe_price' => 'price_test_pro', 'quantity' => 1,
    ]);

    // Pro = 10 webhook endpoints. 9 → can add. 10 → cannot.
    WebhookEndpoint::factory()->count(9)->create();
    expect($this->limits->canAddWebhook($this->workspace->fresh()))->toBeTrue();

    WebhookEndpoint::factory()->create();
    expect($this->limits->canAddWebhook($this->workspace->fresh()))->toBeFalse();
});

it('Business plan reports unlimited (null) for questionnaires', function () {
    Subscription::create([
        'workspace_id' => $this->workspace->id, 'type' => 'default',
        'stripe_id' => 'sub_test_'.uniqid(), 'stripe_status' => 'active',
        'stripe_price' => 'price_test_business', 'quantity' => 1,
    ]);

    Questionnaire::factory()->count(100)->create();

    expect($this->limits->canCreateQuestionnaire($this->workspace->fresh()))->toBeTrue();
    expect($this->limits->limitsFor($this->workspace->fresh())['questionnaires'])->toBeNull();
});

it('summary returns used/limit/remaining/pct per resource', function () {
    Questionnaire::factory()->count(2)->create();
    AiUsage::create([
        'workspace_id' => $this->workspace->id,
        'kind' => 'other', 'provider' => 'fake', 'model' => 'fake',
        'prompt_tokens' => 1, 'completion_tokens' => 1, 'cost_cents' => 1,
    ]);

    $s = $this->limits->summary($this->workspace);

    expect($s['questionnaires']['used'])->toBe(2);
    expect($s['questionnaires']['limit'])->toBe(3);
    expect($s['questionnaires']['remaining'])->toBe(1);
    expect($s['questionnaires']['pct'])->toBe(67);

    expect($s['ai_calls_per_month']['used'])->toBe(1);
    expect($s['ai_calls_per_month']['limit'])->toBe(20);
});

it('responsesOverLimit is true once monthly responses meet the cap', function () {
    Response::factory()->count(100)->create(); // free limit

    expect($this->limits->responsesOverLimit($this->workspace))->toBeTrue();

    // Business plan: null limit → never over.
    Subscription::create([
        'workspace_id' => $this->workspace->id, 'type' => 'default',
        'stripe_id' => 'sub_test_'.uniqid(), 'stripe_status' => 'active',
        'stripe_price' => 'price_test_business', 'quantity' => 1,
    ]);
    expect($this->limits->responsesOverLimit($this->workspace->fresh()))->toBeFalse();
});
