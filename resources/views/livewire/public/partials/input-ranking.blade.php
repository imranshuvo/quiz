@php
    $current = is_array($value) ? array_values($value) : [];
    $byValue = $q->options->keyBy('value');
    $rankedOptions = collect($current)->map(fn ($v) => $byValue[$v] ?? null)->filter()->values();
    $unrankedOptions = $q->options->whereNotIn('value', $current);
@endphp
<div class="space-y-2" wire:key="rank-{{ $q->id }}">
    @foreach ($rankedOptions as $i => $opt)
        <div class="flex items-center gap-3 rounded-xl border border-accent/40 bg-accent/5 px-4 py-3">
            <span class="flex h-7 w-7 items-center justify-center rounded-md bg-accent text-accent-foreground text-sm font-semibold tabular-nums">{{ $i + 1 }}</span>
            <span class="flex-1">{{ $opt->label }}</span>
            <flux:button size="xs" variant="ghost" icon="x-mark"
                wire:click="setScalar({{ $q->id }}, @js(array_values(array_filter($current, fn($v) => $v !== $opt->value))))"
            />
        </div>
    @endforeach

    @if ($unrankedOptions->isNotEmpty())
        @if ($rankedOptions->isNotEmpty())
            <p class="pt-3 text-xs text-zinc-500">Click in the order you prefer:</p>
        @else
            <p class="text-xs text-zinc-500">Click items in your preferred order. They'll be ranked top to bottom.</p>
        @endif
        <div class="flex flex-wrap gap-2 pt-1">
            @foreach ($unrankedOptions as $opt)
                <flux:button size="sm" variant="ghost" icon="plus"
                    wire:click="setScalar({{ $q->id }}, @js([...$current, $opt->value]))"
                >{{ $opt->label }}</flux:button>
            @endforeach
        </div>
    @endif
</div>
