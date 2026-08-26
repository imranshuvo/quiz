@php
    $current = (int) (is_array($value) ? ($value[0] ?? 0) : $value);
    $max = (int) ($q->meta['max_score'] ?? 5);
@endphp
<div class="flex justify-center gap-2 py-2">
    @for ($n = 1; $n <= $max; $n++)
        @php $active = $n <= $current; @endphp
        <button
            type="button"
            wire:click="setScalar({{ $q->id }}, {{ $n }})"
            class="rounded transition-transform hover:scale-110 focus-visible:ring-2 focus-visible:ring-accent"
            aria-label="{{ $n }} out of {{ $max }} stars"
            aria-pressed="{{ $current === $n ? 'true' : 'false' }}"
        >
            <flux:icon.star class="size-10 {{ $active ? 'fill-amber-400 stroke-amber-400' : 'stroke-zinc-300 dark:stroke-zinc-600' }}" />
        </button>
    @endfor
</div>
