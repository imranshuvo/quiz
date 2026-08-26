<?php

namespace App\Services\AI;

use App\Enums\AiUsageKind;
use App\Models\AiUsage;
use App\Models\Workspace;
use Illuminate\Support\Facades\Log;
use Prism\Prism\Contracts\Schema;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

/**
 * Thin Prism facade that:
 *   - Resolves provider+model per task from config/ai.php
 *   - Records every call into the ai_usages ledger so the admin panel can
 *     see per-workspace spend without going to the billing system.
 *
 * Callers go through `text()` or `structured()`; tests can use Prism::fake()
 * to stub out the underlying responses.
 */
class Brain
{
    public function structured(
        AiUsageKind $kind,
        string $prompt,
        Schema $schema,
        ?string $system = null,
        ?Workspace $workspace = null,
        ?int $userId = null,
        array $meta = [],
    ): array {
        [$provider, $model] = $this->modelFor($kind);

        $request = Prism::structured()
            ->using($provider, $model)
            ->withSchema($schema)
            ->withPrompt($prompt);

        if ($system !== null) {
            $request = $request->withSystemPrompt($system);
        }

        $response = $request->asStructured();

        $this->recordUsage(
            workspace: $workspace,
            userId: $userId,
            kind: $kind,
            provider: $provider->value,
            model: $model,
            promptTokens: $response->usage->promptTokens,
            completionTokens: $response->usage->completionTokens,
            meta: $meta,
        );

        return $response->structured ?? [];
    }

    public function text(
        AiUsageKind $kind,
        string $prompt,
        ?string $system = null,
        ?Workspace $workspace = null,
        ?int $userId = null,
        array $meta = [],
    ): string {
        [$provider, $model] = $this->modelFor($kind);

        $request = Prism::text()
            ->using($provider, $model)
            ->withPrompt($prompt);

        if ($system !== null) {
            $request = $request->withSystemPrompt($system);
        }

        $response = $request->asText();

        $this->recordUsage(
            workspace: $workspace,
            userId: $userId,
            kind: $kind,
            provider: $provider->value,
            model: $model,
            promptTokens: $response->usage->promptTokens,
            completionTokens: $response->usage->completionTokens,
            meta: $meta,
        );

        return $response->text;
    }

    /** @return array{0: Provider, 1: string} */
    protected function modelFor(AiUsageKind $kind): array
    {
        $taskKey = $kind->value;
        $task = config("ai.tasks.$taskKey", []);

        $providerName = ($task['provider'] ?? null) ?: config('ai.default_provider', 'anthropic');
        $model = ($task['model'] ?? null) ?: config('ai.default_model', 'claude-sonnet-4-6');

        return [Provider::from((string) $providerName), (string) $model];
    }

    protected function recordUsage(
        ?Workspace $workspace,
        ?int $userId,
        AiUsageKind $kind,
        string $provider,
        string $model,
        int $promptTokens,
        int $completionTokens,
        array $meta,
    ): void {
        if (! $workspace) {
            // No workspace context → can't ledger this safely. Log and bail.
            Log::warning('AI call made without workspace context; usage not recorded.', [
                'kind' => $kind->value,
                'provider' => $provider,
                'model' => $model,
            ]);

            return;
        }

        $costs = config("ai.cost_per_million_tokens_cents.$provider", ['input' => 0, 'output' => 0]);
        $costCents = (int) round(
            ($promptTokens * $costs['input'] + $completionTokens * $costs['output']) / 1_000_000,
        );

        AiUsage::create([
            'workspace_id' => $workspace->id,
            'user_id' => $userId,
            'kind' => $kind,
            'provider' => $provider,
            'model' => $model,
            'prompt_tokens' => $promptTokens,
            'completion_tokens' => $completionTokens,
            'cost_cents' => $costCents,
            'meta' => $meta,
        ]);
    }
}
