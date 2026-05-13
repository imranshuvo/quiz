<div class="space-y-3">
    <div class="flex flex-wrap items-start justify-between gap-3">
        <div class="space-y-1">
            <flux:heading size="lg">{{ $questionnaire->title }}</flux:heading>
            <div class="flex items-center gap-2 text-xs">
                <flux:badge size="sm" variant="subtle">{{ $questionnaire->kind->label() }}</flux:badge>
                <flux:badge size="sm" :color="$questionnaire->status->value === 'published' ? 'lime' : 'zinc'">
                    {{ $questionnaire->status->label() }}
                </flux:badge>
            </div>
        </div>
        <flux:button size="sm" variant="ghost" icon="arrow-up-left" :href="route('questionnaires.index')" wire:navigate>
            All questionnaires
        </flux:button>
    </div>
    @php $a = $active ?? 'edit'; @endphp
    <flux:navbar class="border-b border-zinc-200 dark:border-zinc-800">
        <flux:navbar.item icon="pencil-square" :href="route('questionnaires.edit', $questionnaire)" :current="$a === 'edit'" wire:navigate>Build</flux:navbar.item>
        <flux:navbar.item icon="inbox" :href="route('questionnaires.responses.index', $questionnaire)" :current="$a === 'responses'" wire:navigate>Responses</flux:navbar.item>
        <flux:navbar.item icon="chart-bar" :href="route('questionnaires.analytics', $questionnaire)" :current="$a === 'analytics'" wire:navigate>Analytics</flux:navbar.item>
        <flux:navbar.item icon="bolt" :href="route('questionnaires.webhooks', $questionnaire)" :current="$a === 'webhooks'" wire:navigate>Webhooks</flux:navbar.item>
    </flux:navbar>
</div>
