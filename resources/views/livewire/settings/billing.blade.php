<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Billing')" :subheading="__($workspace->name.' is on the '.$currentPlan->label().' plan.')">
        @if (request()->query('checkout') === 'success')
            <flux:callout icon="check-circle" color="lime" class="mb-4">
                Subscription updated. Welcome to {{ $currentPlan->label() }}!
            </flux:callout>
        @elseif (request()->query('checkout') === 'cancelled')
            <flux:callout icon="exclamation-triangle" color="amber" class="mb-4">
                Checkout cancelled. No changes were made.
            </flux:callout>
        @endif

        {{-- Current plan --}}
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 p-5 space-y-4">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <flux:badge size="sm" :color="$currentPlan->isPaid() ? 'lime' : 'zinc'">
                        {{ $currentPlan->label() }}
                    </flux:badge>
                    @if ($subscription?->onTrial())
                        <flux:badge size="sm" color="amber" class="ms-1">
                            Trial · ends {{ $subscription->trial_ends_at->diffForHumans() }}
                        </flux:badge>
                    @elseif ($subscription?->onGracePeriod())
                        <flux:badge size="sm" color="amber" class="ms-1">
                            Cancels {{ $subscription->ends_at->diffForHumans() }}
                        </flux:badge>
                    @endif
                </div>
                @if ($canManageBilling && $currentPlan->isPaid())
                    <form method="POST" action="{{ route('billing.portal') }}">
                        @csrf
                        <flux:button type="submit" size="sm" variant="ghost" icon="cog">Manage billing</flux:button>
                    </form>
                @endif
            </div>

            {{-- Usage bars --}}
            <div class="space-y-3">
                @foreach ([
                    'questionnaires' => 'Questionnaires',
                    'responses_per_month' => 'Responses this month',
                    'ai_calls_per_month' => 'AI calls this month',
                    'team_members' => 'Team members',
                    'webhooks' => 'Webhook endpoints',
                ] as $key => $label)
                    @php $row = $summary[$key] ?? null; @endphp
                    @if ($row)
                        <div>
                            <div class="flex items-baseline justify-between text-sm">
                                <span>{{ $label }}</span>
                                <span class="tabular-nums text-zinc-500">
                                    {{ $row['used'] }} / {{ $row['limit'] === null ? '∞' : $row['limit'] }}
                                </span>
                            </div>
                            <div class="mt-1 h-2 w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-800">
                                <div
                                    class="h-full rounded-full {{ ($row['pct'] ?? 0) >= 90 ? 'bg-rose-500' : 'bg-gradient-to-r from-indigo-500 to-fuchsia-500' }} transition-[width]"
                                    style="width: {{ $row['pct'] ?? 5 }}%"
                                ></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Plan picker --}}
        <flux:heading size="sm" class="mt-8 mb-3">Change plan</flux:heading>
        <div class="grid gap-4 sm:grid-cols-3">
            @foreach ($plans as $plan)
                @php
                    $isCurrent = $plan === $currentPlan;
                    $cents = (int) config("billing.plans.{$plan->value}.monthly_price_cents", 0);
                    $limits = (array) config("billing.plans.{$plan->value}.limits", []);
                @endphp
                <div class="rounded-2xl border p-5 space-y-3 {{ $isCurrent ? 'border-accent ring-2 ring-accent/30' : 'border-zinc-200 dark:border-zinc-800' }}">
                    <div class="flex items-baseline justify-between">
                        <p class="font-semibold">{{ $plan->label() }}</p>
                        @if ($isCurrent)
                            <flux:badge size="sm" color="lime">Current</flux:badge>
                        @endif
                    </div>
                    <p class="text-3xl font-bold tabular-nums">
                        {{ $cents === 0 ? 'Free' : '€'.number_format($cents / 100, 0) }}
                        @if ($cents > 0)
                            <span class="text-sm font-normal text-zinc-500">/month</span>
                        @endif
                    </p>
                    <ul class="space-y-1 text-sm text-zinc-600 dark:text-zinc-400">
                        @foreach ([
                            'questionnaires' => 'questionnaires',
                            'responses_per_month' => 'responses / mo',
                            'ai_calls_per_month' => 'AI calls / mo',
                            'team_members' => 'team members',
                            'webhooks' => 'webhooks',
                        ] as $k => $label)
                            @php $v = $limits[$k] ?? 0; @endphp
                            <li class="flex items-center gap-1.5">
                                <flux:icon.check class="size-3.5 text-emerald-500" />
                                {{ $v === null ? 'Unlimited' : ($v === 0 ? 'No' : number_format($v)) }} {{ $label }}
                            </li>
                        @endforeach
                    </ul>

                    @if ($plan->isPaid() && ! $isCurrent && $canManageBilling)
                        <form method="POST" action="{{ route('billing.checkout', $plan->value) }}">
                            @csrf
                            <flux:button type="submit" variant="primary" class="w-full" icon="credit-card">
                                {{ $currentPlan->isPaid() ? 'Switch to '.$plan->label() : 'Upgrade to '.$plan->label() }}
                            </flux:button>
                        </form>
                    @elseif (! $plan->isPaid() && $isCurrent)
                        <flux:button variant="ghost" class="w-full" disabled>You're on Free</flux:button>
                    @endif
                </div>
            @endforeach
        </div>

        @if (! $canManageBilling)
            <flux:callout icon="lock-closed" color="zinc" class="mt-6">
                Only the workspace owner can change billing.
            </flux:callout>
        @endif
    </x-settings.layout>
</section>
