<?php

use App\Events\ResponseSubmitted;
use App\Jobs\DeliverWebhook;
use App\Listeners\DispatchWebhooks;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\WebhookDelivery;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('webhook endpoints get a 48-char secret on create', function () {
    $q = Questionnaire::factory()->create();

    $e = WebhookEndpoint::create([
        'questionnaire_id' => $q->id,
        'name' => 'Slack',
        'url' => 'https://example.com/hook',
    ]);

    expect(strlen($e->secret))->toBe(48);
    expect($e->active)->toBeTrue();
});

it('DispatchWebhooks listener queues one DeliverWebhook job per active endpoint', function () {
    Bus::fake([DeliverWebhook::class]);

    $q = Questionnaire::factory()->create();
    WebhookEndpoint::create(['questionnaire_id' => $q->id, 'name' => 'A', 'url' => 'https://a.example.com']);
    WebhookEndpoint::create(['questionnaire_id' => $q->id, 'name' => 'B', 'url' => 'https://b.example.com', 'active' => false]);
    WebhookEndpoint::create(['questionnaire_id' => null, 'name' => 'Workspace-wide', 'url' => 'https://w.example.com']);
    // Different questionnaire — must NOT fire
    $other = Questionnaire::factory()->create();
    WebhookEndpoint::create(['questionnaire_id' => $other->id, 'name' => 'C', 'url' => 'https://c.example.com']);

    $r = Response::factory()->forQuestionnaire($q)->submitted()->create();

    (new DispatchWebhooks)->handle(new ResponseSubmitted($r));

    Bus::assertDispatchedTimes(DeliverWebhook::class, 2); // active for q + workspace-wide
});

it('DeliverWebhook posts a JSON body with HMAC-SHA256 signature header', function () {
    Http::fake([
        'https://example.com/hook' => Http::response('ok', 200),
    ]);

    $q = Questionnaire::factory()->create();
    $endpoint = WebhookEndpoint::create([
        'questionnaire_id' => $q->id,
        'name' => 'Test',
        'url' => 'https://example.com/hook',
        'secret' => 'fixed-secret',
    ]);
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'a']);
    $r = Response::factory()->forQuestionnaire($q)->submitted()->create([
        'respondent_email' => 'r@example.com', 'score' => 1, 'max_score' => 1,
    ]);
    ResponseAnswer::factory()->pair($r, $question)->create(['value' => ['a']]);

    (new DeliverWebhook($endpoint->id, $r->id, $this->workspace->id))
        ->handle(app(Tenancy::class));

    Http::assertSent(function ($request) use ($endpoint) {
        $body = $request->body();
        $expectedSignature = 'sha256='.hash_hmac('sha256', $body, $endpoint->secret);

        return $request->url() === $endpoint->url
            && $request->method() === 'POST'
            && $request->header('X-Signature-256')[0] === $expectedSignature
            && $request->header('X-Event')[0] === 'response.submitted'
            && str_contains($body, '"event":"response.submitted"')
            && str_contains($body, 'r@example.com');
    });

    $delivery = WebhookDelivery::first();
    expect($delivery->status)->toBe('success');
    expect($delivery->http_status)->toBe(200);
    expect($delivery->attempts)->toBe(1);
    expect($endpoint->fresh()->last_delivered_at)->not->toBeNull();
});

it('DeliverWebhook records a failure and releases for retry on non-2xx', function () {
    Http::fake([
        'https://example.com/hook' => Http::response('boom', 500),
    ]);

    $q = Questionnaire::factory()->create();
    $endpoint = WebhookEndpoint::create([
        'questionnaire_id' => $q->id,
        'name' => 'Test',
        'url' => 'https://example.com/hook',
    ]);
    $r = Response::factory()->forQuestionnaire($q)->submitted()->create();

    (new DeliverWebhook($endpoint->id, $r->id, $this->workspace->id))
        ->handle(app(Tenancy::class));

    $delivery = WebhookDelivery::first();
    expect($delivery->status)->toBe('failed');
    expect($delivery->http_status)->toBe(500);
    expect($delivery->last_error)->toContain('boom');
});

it('end-to-end: submit a response and webhook job is queued', function () {
    Bus::fake([DeliverWebhook::class]);

    $q = Questionnaire::factory()->create();
    WebhookEndpoint::create(['questionnaire_id' => $q->id, 'name' => 'A', 'url' => 'https://a.example.com']);

    $r = Response::factory()->forQuestionnaire($q)->submitted()->create();

    event(new ResponseSubmitted($r));

    Bus::assertDispatched(DeliverWebhook::class);
});
