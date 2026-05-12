@php
    $current = is_array($value) ? ($value[0] ?? null) : $value;
    $min = (int) ($q->meta['scale_min'] ?? 1);
    $max = (int) ($q->meta['scale_max'] ?? 5);
    $minLabel = $q->meta['min_label'] ?? 'Strongly disagree';
    $maxLabel = $q->meta['max_label'] ?? 'Strongly agree';
@endphp
<div class="space-y-3">
    <div class="grid grid-cols-{{ $max - $min + 1 }} gap-2">
        @for ($n = $min; $n <= $max; $n++)
            @php $isSel = (string) $current === (string) $n; @endphp
            <button
                type="button"
                wire:click="setScalar({{ $q->id }}, {{ $n }})"
                class="rounded-xl border py-4 text-lg font-medium transition {{ $isSel ? 'border-accent bg-accent text-accent-foreground' : 'border-zinc-200 dark:border-zinc-700 hover:border-zinc-400 dark:hover:border-zinc-500' }}"
            >
                {{ $n }}
            </button>
        @endfor
    </div>
    <div class="flex justify-between text-xs text-zinc-500">
        <span>{{ $minLabel }}</span>
        <span>{{ $maxLabel }}</span>
    </div>
</div>
