<?php

namespace App\Services\Billing;

use App\Enums\Plan;
use App\Models\AiUsage;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;

/**
 * Knows what plan a workspace is on, what its current usage is, and whether
 * a given gated action is allowed under that plan.
 *
 * All "can…" methods return TRUE for `null` limits (unlimited), FALSE for
 * `0` limits (feature disabled), and a count-vs-limit comparison otherwise.
 */
class Limits
{
    public function planFor(Workspace $workspace): Plan
    {
        $sub = $workspace->subscription(config('billing.subscription_name', 'default'));

        if (! $sub || ! $sub->valid()) {
            return Plan::Free;
        }

        return Plan::fromStripePrice($sub->stripe_price);
    }

    /** @return array<string, int|null>  e.g. ['questionnaires' => 3, …] */
    public function limitsFor(Workspace $workspace): array
    {
        $plan = $this->planFor($workspace);

        return (array) config("billing.plans.{$plan->value}.limits", []);
    }

    /** @return array<string, int>  current usage counts per limit key */
    public function usageFor(Workspace $workspace): array
    {
        $monthStart = now()->startOfMonth();

        return [
            'questionnaires' => Questionnaire::query()
                ->withoutWorkspaceScope()
                ->where('workspace_id', $workspace->id)
                ->count(),
            'responses_per_month' => Response::query()
                ->withoutWorkspaceScope()
                ->where('workspace_id', $workspace->id)
                ->where('created_at', '>=', $monthStart)
                ->count(),
            'ai_calls_per_month' => AiUsage::query()
                ->withoutWorkspaceScope()
                ->where('workspace_id', $workspace->id)
                ->where('created_at', '>=', $monthStart)
                ->count(),
            'team_members' => $workspace->memberships()->count(),
            'webhooks' => WebhookEndpoint::query()
                ->withoutWorkspaceScope()
                ->where('workspace_id', $workspace->id)
                ->count(),
        ];
    }

    /**
     * Lightweight summary shape used by the billing UI and gate sites:
     *   [ key => [ 'used' => int, 'limit' => int|null, 'remaining' => int|null ] ]
     */
    public function summary(Workspace $workspace): array
    {
        $usage = $this->usageFor($workspace);
        $limits = $this->limitsFor($workspace);
        $out = [];
        foreach ($limits as $key => $limit) {
            $used = $usage[$key] ?? 0;
            $remaining = $limit === null ? null : max(0, $limit - $used);
            $out[$key] = [
                'used' => $used,
                'limit' => $limit,
                'remaining' => $remaining,
                'pct' => $this->percent($used, $limit),
            ];
        }

        return $out;
    }

    public function canCreateQuestionnaire(Workspace $workspace): bool
    {
        return $this->under('questionnaires', $workspace);
    }

    public function canMakeAiCall(Workspace $workspace): bool
    {
        return $this->under('ai_calls_per_month', $workspace);
    }

    public function canInviteMember(Workspace $workspace): bool
    {
        return $this->under('team_members', $workspace);
    }

    public function canAddWebhook(Workspace $workspace): bool
    {
        return $this->under('webhooks', $workspace);
    }

    /** Soft check used to surface a banner — responses are NEVER hard-blocked. */
    public function responsesOverLimit(Workspace $workspace): bool
    {
        $limit = $this->limitsFor($workspace)['responses_per_month'] ?? null;
        if ($limit === null) {
            return false;
        }
        $used = $this->usageFor($workspace)['responses_per_month'] ?? 0;

        return $used >= $limit;
    }

    protected function under(string $key, Workspace $workspace): bool
    {
        $limit = $this->limitsFor($workspace)[$key] ?? null;

        if ($limit === null) {
            return true;   // unlimited
        }
        if ($limit === 0) {
            return false;  // feature disabled on this plan
        }

        $used = $this->usageFor($workspace)[$key] ?? 0;

        return $used < $limit;
    }

    protected function percent(int $used, ?int $limit): ?int
    {
        if ($limit === null) {
            return null;
        }
        if ($limit <= 0) {
            return 100;
        }

        return min(100, (int) round(($used / $limit) * 100));
    }
}
