<div class="mx-auto w-full max-w-6xl p-6 space-y-6">
    @include('livewire.questionnaires.partials.subnav', ['questionnaire' => $questionnaire, 'active' => 'analytics'])

    <div class="flex justify-end">
        <flux:button size="sm" variant="ghost" icon="document-arrow-down" :href="route('questionnaires.analytics.pdf', $questionnaire)">Export PDF</flux:button>
    </div>

    {{-- Top stats --}}
    <div class="grid gap-3 sm:grid-cols-4">
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Submitted</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums">{{ $summary['submitted'] }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">In progress</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums">{{ $summary['in_progress'] }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Completion</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums">{{ $summary['completion_rate'] }}%</p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Avg score</p>
            <p class="mt-1 text-2xl font-semibold tabular-nums">
                {{ $summary['average_score_pct'] !== null ? $summary['average_score_pct'].'%' : '—' }}
            </p>
        </div>
    </div>

    {{-- AI insights panel --}}
    <div class="rounded-2xl border border-fuchsia-200/60 dark:border-fuchsia-500/30 bg-gradient-to-br from-indigo-50 to-fuchsia-50 dark:from-indigo-950/40 dark:to-fuchsia-950/40 p-6 space-y-4">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-start gap-3">
                <flux:icon.sparkles class="size-6 text-fuchsia-500 mt-0.5 shrink-0" />
                <div>
                    <flux:heading size="md">AI Insights</flux:heading>
                    <flux:subheading>
                        @if ($insights)
                            Generated {{ \Illuminate\Support\Carbon::parse($insights['generated_at'])->diffForHumans() }} from {{ $summary['submitted'] }} response{{ $summary['submitted'] === 1 ? '' : 's' }}.
                        @else
                            Run an analysis to surface themes, sentiment, and a summary.
                        @endif
                    </flux:subheading>
                </div>
            </div>
            <flux:button
                size="sm"
                variant="primary"
                icon="sparkles"
                wire:click="runInsights"
                :loading="$analyzing"
            >{{ $analyzing ? 'Analyzing…' : ($insights ? 'Re-analyze' : 'Run analysis') }}</flux:button>
        </div>

        @if ($analyzeError)
            <flux:callout icon="exclamation-triangle" color="red">{{ $analyzeError }}</flux:callout>
        @endif

        @if ($insights)
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-xl bg-white/60 dark:bg-zinc-900/40 p-4 md:col-span-1">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Sentiment</p>
                    <p class="mt-1 text-2xl font-semibold capitalize">{{ $insights['sentiment'] }}</p>
                </div>
                <div class="rounded-xl bg-white/60 dark:bg-zinc-900/40 p-4 md:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Summary</p>
                    <p class="mt-1 text-sm leading-relaxed">{{ $insights['summary'] }}</p>
                </div>
            </div>

            @if (! empty($insights['themes']))
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-wider text-zinc-500">Top themes</p>
                    <div class="grid gap-2 md:grid-cols-2">
                        @foreach ($insights['themes'] as $theme)
                            <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white/60 dark:bg-zinc-900/40 px-4 py-3">
                                <p class="font-medium">{{ $theme['label'] ?? '' }}</p>
                                @if (! empty($theme['supporting_quote']))
                                    <p class="mt-1 text-sm italic text-zinc-600 dark:text-zinc-400">“{{ $theme['supporting_quote'] }}”</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>

    {{-- Score histogram (assessments only) --}}
    @if ($questionnaire->kind->isGraded() && ! empty($histogram) && array_sum($histogram) > 0)
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 p-6 space-y-3">
            <flux:heading size="md">Score distribution</flux:heading>
            <div
                wire:ignore
                x-data="scoreHistogram({{ json_encode(array_values($histogram)) }})"
                x-init="render()"
                class="relative h-64"
            >
                <canvas x-ref="canvas"></canvas>
            </div>
        </div>
    @endif

    {{-- NPS gauge --}}
    @if ($nps)
        <div class="rounded-2xl border border-zinc-200 dark:border-zinc-800 p-6 space-y-3">
            <div class="flex items-baseline justify-between gap-3">
                <flux:heading size="md">NPS</flux:heading>
                <flux:text size="sm" class="text-zinc-500">{{ $nps['question_title'] }}</flux:text>
            </div>
            <div class="grid gap-4 md:grid-cols-2 items-center">
                <div class="text-center md:text-left space-y-1">
                    <p class="text-6xl font-bold tabular-nums {{ $nps['score'] >= 30 ? 'text-emerald-500' : ($nps['score'] >= 0 ? 'text-amber-500' : 'text-rose-500') }}">
                        {{ $nps['score'] }}
                    </p>
                    <p class="text-sm text-zinc-500">based on {{ $nps['sample'] }} responses</p>
                </div>
                <div class="space-y-2">
                    @foreach ([
                        ['Promoters', $nps['promoters'], 'bg-emerald-500'],
                        ['Passives', $nps['passives'], 'bg-amber-400'],
                        ['Detractors', $nps['detractors'], 'bg-rose-500'],
                    ] as [$label, $count, $color])
                        @php $pct = $nps['sample'] > 0 ? round(($count / $nps['sample']) * 100, 1) : 0; @endphp
                        <div class="space-y-1">
                            <div class="flex items-baseline justify-between text-sm">
                                <span class="font-medium">{{ $label }}</span>
                                <span class="tabular-nums text-zinc-500">{{ $count }} · {{ $pct }}%</span>
                            </div>
                            <div class="h-2 w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-800">
                                <div class="h-full {{ $color }} rounded-full transition-[width]" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Per-question breakdown --}}
    <div class="space-y-4">
        <flux:heading size="md">Per-question breakdown</flux:heading>
        @foreach ($perQuestion as $row)
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 space-y-3">
                <div class="flex items-baseline justify-between gap-3">
                    <p class="font-medium">{{ $row['title'] }}</p>
                    <flux:badge size="sm" variant="subtle">{{ $row['type_label'] }} · {{ $row['answer_count'] }} answers</flux:badge>
                </div>

                @if (! empty($row['tallies']))
                    <div class="space-y-2">
                        @foreach ($row['tallies'] as $t)
                            <div class="space-y-1">
                                <div class="flex items-baseline justify-between text-sm gap-3">
                                    <span class="flex items-center gap-1.5">
                                        @if ($t['is_correct'])
                                            <flux:icon.check-circle class="size-3.5 text-emerald-500" />
                                        @endif
                                        {{ $t['label'] }}
                                    </span>
                                    <span class="tabular-nums text-zinc-500">{{ $t['count'] }} · {{ $t['percent'] }}%</span>
                                </div>
                                <div class="h-2 w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-800">
                                    <div class="h-full rounded-full {{ $t['is_correct'] ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-fuchsia-500' }} transition-[width]" style="width: {{ $t['percent'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif (! empty($row['histogram']))
                    @php $maxCount = max(array_values($row['histogram']) ?: [1]); @endphp
                    <div class="grid gap-1" style="grid-template-columns: repeat({{ count($row['histogram']) }}, minmax(0, 1fr));">
                        @foreach ($row['histogram'] as $n => $count)
                            <div class="flex flex-col items-center gap-1">
                                <div class="flex h-32 w-full items-end">
                                    <div class="w-full rounded-t bg-gradient-to-t from-indigo-500 to-fuchsia-500" style="height: {{ $maxCount > 0 ? max(2, ($count / $maxCount) * 100) : 2 }}%"></div>
                                </div>
                                <span class="text-xs tabular-nums text-zinc-500">{{ $n }}</span>
                                <span class="text-[10px] tabular-nums text-zinc-400">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                @elseif (! empty($row['samples']))
                    <ul class="space-y-2">
                        @foreach ($row['samples'] as $s)
                            <li class="rounded-lg bg-zinc-50 dark:bg-zinc-900 px-3 py-2 text-sm italic">“{{ $s }}”</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-zinc-500">No answers yet.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>

@script
<script>
    Alpine.data('scoreHistogram', (data) => ({
        chart: null,
        render() {
            if (this.chart) this.chart.destroy();
            const ctx = this.$refs.canvas.getContext('2d');
            const grad = ctx.createLinearGradient(0, 0, 0, 256);
            grad.addColorStop(0, 'rgba(217, 70, 239, 0.85)');
            grad.addColorStop(1, 'rgba(99, 102, 241, 0.5)');

            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80-89', '90-100'],
                    datasets: [{
                        data,
                        backgroundColor: grad,
                        borderRadius: 6,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } },
                    },
                },
            });
        },
    }));
</script>
@endscript
