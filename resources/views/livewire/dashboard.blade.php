<div class="mx-auto w-full max-w-6xl space-y-8 p-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <flux:heading size="xl" level="1">Dashboard</flux:heading>
            <flux:subheading>{{ $workspace ? 'A quick look at '.$workspace->name.'.' : 'Create or join a workspace to get started.' }}</flux:subheading>
        </div>
        @if ($workspace)
            <flux:button variant="primary" icon="plus" :href="route('questionnaires.index')" wire:navigate>New questionnaire</flux:button>
        @endif
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4" aria-label="Workspace summary">
        @foreach ([
            ['label' => 'Questionnaires', 'value' => $stats['questionnaires']],
            ['label' => 'Published', 'value' => $stats['published']],
            ['label' => 'Responses', 'value' => $stats['responses']],
            ['label' => 'Completion rate', 'value' => $stats['completion_rate'].'%'],
        ] as $stat)
            <div class="rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500">{{ $stat['label'] }}</p>
                <p class="mt-2 text-3xl font-semibold tabular-nums">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-2xl border border-zinc-200 p-5 dark:border-zinc-700" aria-labelledby="recent-questionnaires-heading">
            <div class="flex items-center justify-between gap-3">
                <flux:heading id="recent-questionnaires-heading" size="md">Recently edited</flux:heading>
                <a class="text-sm underline-offset-4 hover:underline" href="{{ route('questionnaires.index') }}" wire:navigate>View all</a>
            </div>

            @if ($recentQuestionnaires->isEmpty())
                <p class="mt-4 text-sm text-zinc-500">No questionnaires yet.</p>
            @else
                <ul class="mt-4 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @foreach ($recentQuestionnaires as $questionnaire)
                        <li class="flex items-center justify-between gap-3 py-3">
                            <div class="min-w-0">
                                <a class="block truncate text-sm font-medium hover:underline" href="{{ route('questionnaires.edit', $questionnaire) }}" wire:navigate>{{ $questionnaire->title }}</a>
                                <p class="text-xs text-zinc-500">{{ $questionnaire->kind->label() }} · {{ $questionnaire->responses_count }} responses</p>
                            </div>
                            <flux:badge size="sm" :color="$questionnaire->status->value === 'published' ? 'lime' : 'zinc'">{{ $questionnaire->status->label() }}</flux:badge>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section class="rounded-2xl border border-zinc-200 p-5 dark:border-zinc-700" aria-labelledby="recent-responses-heading">
            <flux:heading id="recent-responses-heading" size="md">Latest responses</flux:heading>

            @if ($recentResponses->isEmpty())
                <p class="mt-4 text-sm text-zinc-500">No responses yet.</p>
            @else
                <ul class="mt-4 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @foreach ($recentResponses as $response)
                        <li class="flex items-center justify-between gap-3 py-3">
                            <div class="min-w-0">
                                <a class="block truncate text-sm font-medium hover:underline" href="{{ route('questionnaires.responses.show', [$response->questionnaire, $response]) }}" wire:navigate>{{ $response->questionnaire->title }}</a>
                                <p class="text-xs text-zinc-500">{{ $response->respondent_email ?: 'Anonymous respondent' }} · {{ $response->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="text-sm tabular-nums">{{ $response->percentage() === null ? '—' : $response->percentage().'%' }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
</div>
