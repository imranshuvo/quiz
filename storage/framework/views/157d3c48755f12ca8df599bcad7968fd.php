<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'columnSpan' => [],
    'columnStart' => [],
    'height' => null,
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
    'columnSpan' => [],
    'columnStart' => [],
    'height' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    <?php echo e(($attributes ?? new \Illuminate\View\ComponentAttributeBag)
            ->gridColumn($columnSpan, $columnStart)
            ->class(['fi-section fi-loading-section'])
            ->style(['height: ' . ($height ?? '8rem')])); ?>

></div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/loading-section.blade.php ENDPATH**/ ?>