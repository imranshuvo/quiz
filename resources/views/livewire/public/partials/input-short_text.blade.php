@php $current = is_array($value) ? ($value[0] ?? '') : (string) $value; @endphp
<flux:input
    wire:keydown.enter.prevent="next"
    wire:change="setScalar({{ $q->id }}, $event.target.value)"
    :value="$current"
    placeholder="Type your answer here..."
    autofocus
    class="!text-lg"
/>
