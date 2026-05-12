@php $picked = is_array($value) ? $value : ($value ? [$value] : []); @endphp
<div class="grid gap-3">
    @foreach ($q->options as $i => $opt)
        @php $isSelected = in_array($opt->value, $picked, true); @endphp
        <button
            type="button"
            wire:click="toggleChoice({{ $q->id }}, @js($opt->value))"
            class="group flex items-center gap-4 rounded-2xl border px-5 py-4 text-left transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-accent {{ $isSelected ? 'border-accent bg-accent/10 dark:bg-accent/20' : 'border-zinc-200 dark:border-zinc-700 hover:border-zinc-400 dark:hover:border-zinc-500' }}"
            aria-pressed="{{ $isSelected ? 'true' : 'false' }}"
        >
            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-md border {{ $isSelected ? 'border-accent bg-accent text-accent-foreground' : 'border-zinc-300 dark:border-zinc-600' }}">
                @if ($isSelected)
                    <flux:icon.check class="size-4" />
                @endif
            </span>
            <span class="flex-1 text-base">{{ $opt->label }}</span>
        </button>
    @endforeach
    <p class="text-xs text-zinc-500 mt-1">Select all that apply.</p>
</div>
