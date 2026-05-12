<?php

use App\Enums\AiUsageKind;
use App\Models\AiUsage;
use App\Models\Workspace;
use App\Services\AI\Brain;
use App\Services\Tenancy;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\Testing\TextResponseFake;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('Brain::structured returns the structured payload and records usage', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured(['hello' => 'world'])
            ->withUsage(new Usage(promptTokens: 100, completionTokens: 50)),
    ]);

    $schema = new ObjectSchema(
        name: 'demo',
        description: 'demo',
        properties: [new StringSchema('hello', 'demo')],
        requiredFields: ['hello'],
    );

    $payload = app(Brain::class)->structured(
        kind: AiUsageKind::GenerateQuestions,
        prompt: 'do the thing',
        schema: $schema,
        workspace: $this->workspace,
    );

    expect($payload)->toBe(['hello' => 'world']);

    $usage = AiUsage::first();
    expect($usage)->not->toBeNull();
    expect($usage->prompt_tokens)->toBe(100);
    expect($usage->completion_tokens)->toBe(50);
    expect($usage->kind)->toBe(AiUsageKind::GenerateQuestions);
    expect($usage->workspace_id)->toBe($this->workspace->id);
});

it('Brain::text returns the text and records usage', function () {
    Prism::fake([
        TextResponseFake::make()
            ->withText('hello there')
            ->withUsage(new Usage(promptTokens: 20, completionTokens: 10)),
    ]);

    $text = app(Brain::class)->text(
        kind: AiUsageKind::Other,
        prompt: 'say hi',
        workspace: $this->workspace,
    );

    expect($text)->toBe('hello there');
    expect(AiUsage::count())->toBe(1);
});

it('Brain skips usage record when no workspace is passed', function () {
    Prism::fake([
        TextResponseFake::make()
            ->withText('orphan')
            ->withUsage(new Usage(promptTokens: 5, completionTokens: 5)),
    ]);

    $text = app(Brain::class)->text(
        kind: AiUsageKind::Other,
        prompt: 'no workspace',
        workspace: null,
    );

    expect($text)->toBe('orphan');
    expect(AiUsage::withoutWorkspaceScope()->count())->toBe(0);
});

it('cost_cents is computed from the per-million-token rates', function () {
    // anthropic: input=300, output=1500 per 1M tokens (from config/ai.php)
    Prism::fake([
        TextResponseFake::make()
            ->withText('ok')
            ->withUsage(new Usage(promptTokens: 1_000_000, completionTokens: 1_000_000)),
    ]);

    app(Brain::class)->text(
        kind: AiUsageKind::Other,
        prompt: 'expensive',
        workspace: $this->workspace,
    );

    expect(AiUsage::first()->cost_cents)->toBe(300 + 1500);
});
