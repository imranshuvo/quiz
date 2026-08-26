@php $current = is_array($value) ? ($value[0] ?? null) : $value; @endphp
<div class="space-y-3">
    <div class="grid grid-cols-11 gap-1.5">
        @for ($n = 0; $n <= 10; $n++)
            @php
                $isSel = (string) $current === (string) $n;
                $hue = match (true) {
                    $n <= 6 => 'from-rose-500 to-red-500',
                    $n <= 8 => 'from-amber-400 to-orange-500',
                    default => 'from-emerald-400 to-green-500',
                };
            @endphp
            <button
                type="button"
                wire:click="setScalar({{ $q->id }}, {{ $n }})"
                aria-pressed="{{ $isSel ? 'true' : 'false' }}"
                aria-label="Net Promoter Score {{ $n }} out of 10"
                class="rounded-lg border py-3 font-semibold tabular-nums transition focus-visible:ring-2 focus-visible:ring-accent {{ $isSel ? 'border-transparent bg-gradient-to-br '.$hue.' text-white shadow-md scale-105' : 'border-zinc-200 dark:border-zinc-700 hover:border-zinc-400 dark:hover:border-zinc-500' }}"
            >
                {{ $n }}
            </button>
        @endfor
    </div>
    <div class="flex justify-between text-xs text-zinc-500">
        <span>Not at all likely</span>
        <span>Extremely likely</span>
    </div>
</div>
