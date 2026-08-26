@php $current = is_array($value) ? ($value[0] ?? '') : (string) $value; @endphp
<flux:textarea
    wire:change="setScalar({{ $q->id }}, $event.target.value)"
    :value="$current"
    :aria-label="$q->title"
    rows="5"
    placeholder="Take your time..."
    autofocus
    class="!text-base"
/>
<p class="text-xs text-zinc-500 mt-2">Tip: Shift + Enter for a new line.</p>
