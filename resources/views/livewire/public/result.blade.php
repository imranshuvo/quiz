<div class="mx-auto flex min-h-screen w-full max-w-2xl flex-col justify-center px-4 py-12 sm:py-20">
    <div
        x-data="{ show: false, score: 0 }"
        x-init="$nextTick(() => { show = true; setTimeout(() => score = {{ (int) ($percentage ?? 0) }}, 200); })"
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        class="space-y-10"
    >
        <div class="text-center space-y-3">
            <flux:icon.check-circle class="mx-auto size-14 text-emerald-500" />
            <h1 class="text-3xl sm:text-4xl font-semibold">Thanks for your time</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Your response to <strong>{{ $questionnaire->title }}</strong> has been recorded.
            </p>
        </div>

        @if ($isGraded && $percentage !== null)
            <div class="rounded-3xl border border-zinc-200 dark:border-zinc-800 bg-white/60 dark:bg-zinc-900/60 backdrop-blur p-8 sm:p-10 space-y-6">
                <div class="text-center space-y-2">
                    <p class="text-sm uppercase tracking-wider text-zinc-500">Your score</p>
                    <p class="text-6xl sm:text-7xl font-bold tabular-nums bg-gradient-to-br from-indigo-500 via-fuchsia-500 to-pink-500 bg-clip-text text-transparent">
                        <span x-text="score">{{ (int) $percentage }}</span>%
                    </p>
                    <p class="text-sm text-zinc-500 tabular-nums">
                        {{ rtrim(rtrim(number_format((float) $response->score, 2), '0'), '.') }} / {{ rtrim(rtrim(number_format((float) $response->max_score, 2), '0'), '.') }} points
                    </p>
                </div>
                <div class="h-3 w-full overflow-hidden rounded-full bg-zinc-200/60 dark:bg-zinc-800">
                    <div
                        class="h-full rounded-full bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-pink-500 transition-[width] duration-1000 ease-out"
                        :style="`width: ${score}%`"
                    ></div>
                </div>
            </div>

            <div class="space-y-3">
                <flux:heading size="md">Question breakdown</flux:heading>
                @foreach ($breakdown as $row)
                    <div class="flex items-start gap-3 rounded-xl border border-zinc-200 dark:border-zinc-800 px-4 py-3 bg-white/40 dark:bg-zinc-900/40">
                        @if ($row['is_correct'])
                            <flux:icon.check-circle class="size-5 shrink-0 text-emerald-500 mt-0.5" />
                        @elseif ($row['is_correct'] === false)
                            <flux:icon.x-circle class="size-5 shrink-0 text-rose-500 mt-0.5" />
                        @else
                            <flux:icon.minus-circle class="size-5 shrink-0 text-zinc-400 mt-0.5" />
                        @endif
                        <div class="flex-1 space-y-1">
                            <p class="text-sm font-medium">{{ $row['question'] }}</p>
                            @if (! $row['is_correct'] && ! empty($row['correct_answers']))
                                <p class="text-xs text-zinc-500">
                                    Correct answer{{ count($row['correct_answers']) > 1 ? 's' : '' }}:
                                    <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ implode(', ', $row['correct_answers']) }}</span>
                                </p>
                            @endif
                        </div>
                        <span class="shrink-0 text-xs tabular-nums text-zinc-500">
                            {{ rtrim(rtrim(number_format($row['score'], 2), '0'), '.') }} / {{ rtrim(rtrim(number_format($row['max'], 2), '0'), '.') }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl border border-zinc-200 dark:border-zinc-800 bg-white/60 dark:bg-zinc-900/60 backdrop-blur p-8 text-center space-y-2">
                <p class="text-zinc-700 dark:text-zinc-300">
                    {{ $response->answers->count() }} answer{{ $response->answers->count() === 1 ? '' : 's' }} recorded.
                </p>
                <p class="text-sm text-zinc-500">
                    The team behind this {{ $questionnaire->kind->label() }} will review responses and follow up if needed.
                </p>
            </div>
        @endif

        <div class="text-center">
            <flux:text size="sm" class="text-zinc-500">Powered by {{ config('app.name') }}</flux:text>
        </div>
    </div>
</div>
