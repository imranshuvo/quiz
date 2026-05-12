@php $selected = is_array($value) ? ($value[0] ?? null) : $value; @endphp
<div class="grid gap-3" role="radiogroup">
    @foreach ($q->options as $i => $opt)
        @php $isSelected = $selected === $opt->value; @endphp
        <button
            type="button"
            wire:click="selectChoice({{ $q->id }}, @js($opt->value))"
            class="group flex items-center gap-4 rounded-2xl border px-5 py-4 text-left transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent {{ $isSelected ? 'border-accent bg-accent/10 dark:bg-accent/20' : 'border-zinc-200 dark:border-zinc-700 hover:border-zinc-400 dark:hover:border-zinc-500' }}"
            aria-checked="{{ $isSelected ? 'true' : 'false' }}"
            role="radio"
        >
            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md border text-[11px] font-semibold tabular-nums {{ $isSelected ? 'border-accent bg-accent text-accent-foreground' : 'border-zinc-300 dark:border-zinc-600 text-zinc-500' }}">
                {{ chr(65 + $i) }}
            </span>
            <span class="flex-1 text-base">{{ $opt->label }}</span>
            @if ($isSelected)
                <flux:icon.check class="size-5 text-accent" />
            @endif
        </button>
    @endforeach
</div>
