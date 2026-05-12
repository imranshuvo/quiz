<div class="mx-auto flex min-h-screen w-full max-w-3xl flex-col px-4 py-8 sm:py-14 space-y-10">
    <header class="space-y-3 text-center">
        <flux:badge color="lime" class="inline-flex items-center gap-1.5">
            <span class="relative flex size-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex size-2 rounded-full bg-emerald-500"></span>
            </span>
            LIVE
        </flux:badge>
        <h1 class="text-3xl sm:text-4xl font-semibold">{{ $questionnaire->title }}</h1>
        @if ($questionnaire->description)
            <p class="text-zinc-600 dark:text-zinc-400">{{ $questionnaire->description }}</p>
        @endif
        <p class="text-sm text-zinc-500 tabular-nums">
            {{ $totalVoters }} {{ $totalVoters === 1 ? 'voter' : 'voters' }}
        </p>
    </header>

    @foreach ($questions as $question)
        @php
            $data = $tallies[$question->id] ?? ['tallies' => [], 'total' => 0];
            $total = max(1, $data['total']);
        @endphp
        <section class="rounded-3xl border border-zinc-200 dark:border-zinc-800 bg-white/60 dark:bg-zinc-900/60 backdrop-blur p-6 sm:p-8 space-y-5">
            <div class="space-y-1">
                <h2 class="text-xl font-semibold leading-snug">{{ $question->title }}</h2>
                @if ($question->helper)
                    <p class="text-sm text-zinc-500">{{ $question->helper }}</p>
                @endif
            </div>

            @if ($question->type->hasOptions())
                <div class="space-y-3">
                    @foreach ($question->options as $opt)
                        @php
                            $count = $data['tallies'][$opt->value] ?? 0;
                            $pct = $data['total'] > 0 ? (int) round(($count / $total) * 100) : 0;
                        @endphp
                        <div class="space-y-1.5">
                            <div class="flex items-baseline justify-between gap-3 text-sm">
                                <span class="font-medium">{{ $opt->label }}</span>
                                <span class="tabular-nums text-zinc-500">{{ $count }} · {{ $pct }}%</span>
                            </div>
                            <div class="h-2.5 w-full overflow-hidden rounded-full bg-zinc-200/70 dark:bg-zinc-800">
                                <div
                                    class="h-full rounded-full bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-pink-500 transition-[width] duration-700 ease-out"
                                    style="width: {{ $pct }}%"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <flux:text size="sm" class="text-zinc-500">
                    Live tallies are only shown for choice questions.
                </flux:text>
            @endif
        </section>
    @endforeach

    <div class="flex justify-center">
        <flux:button :href="route('public.taker', $questionnaire->slug)" variant="primary" icon="hand-raised">
            Cast your vote
        </flux:button>
    </div>

    <p class="text-center text-xs text-zinc-500">
        Updates live as votes come in. Powered by {{ config('app.name') }}.
    </p>
</div>
