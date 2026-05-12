

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'key' => null,
    'sticky' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'key' => null,
    'sticky' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = Flux::classes()
    ->add($sticky ? 'last:sticky last:bottom-0 last:z-20' : '')
    ;
?>

<tr <?php if($key): ?> <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'table-'.e($key).''; ?>wire:key="table-<?php echo e($key); ?>" <?php endif; ?> <?php echo e($attributes->class($classes)); ?> data-flux-row>
    <?php echo e($slot); ?>

</tr>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/table/row.blade.php ENDPATH**/ ?>