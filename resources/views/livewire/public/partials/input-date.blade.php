@php $current = is_array($value) ? ($value[0] ?? '') : (string) $value; @endphp
<flux:input
    type="date"
    wire:change="setScalar({{ $q->id }}, $event.target.value)"
    :value="$current"
    class="!text-lg max-w-xs"
/>
