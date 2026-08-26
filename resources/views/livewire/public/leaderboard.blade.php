<div class="mx-auto min-h-screen w-full max-w-3xl px-4 py-10 sm:py-16">
    <header class="text-center">
        <flux:badge color="amber">Leaderboard</flux:badge>
        <h1 class="mt-4 text-3xl font-semibold sm:text-4xl">{{ $questionnaire->title }}</h1>
        <p class="mt-2 text-sm text-zinc-500" aria-live="polite">Updates live as responses are submitted.</p>
    </header>

    @if ($leaders->isEmpty())
        <flux:callout class="mt-10" icon="trophy" color="zinc">No scored responses yet. Be the first.</flux:callout>
    @else
        <ol class="mt-10 space-y-3" aria-label="Quiz leaders">
            @foreach ($leaders as $index => $response)
                <li class="flex items-center gap-4 rounded-2xl border border-zinc-200 bg-white/70 px-5 py-4 dark:border-zinc-700 dark:bg-zinc-900/70">
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full {{ $index < 3 ? 'bg-amber-400 text-amber-950' : 'bg-zinc-200 dark:bg-zinc-700' }} font-semibold tabular-nums">{{ $index + 1 }}</span>
                    <span class="min-w-0 flex-1 truncate font-medium">{{ $response->respondent?->name ?? 'Anonymous #'.$response->id }}</span>
                    <span class="text-lg font-semibold tabular-nums">{{ $response->percentage() }}%</span>
                </li>
            @endforeach
        </ol>
    @endif

    <div class="mt-8 text-center">
        <flux:button variant="primary" :href="route('public.taker', $questionnaire->slug)">Take the quiz</flux:button>
    </div>
</div>
