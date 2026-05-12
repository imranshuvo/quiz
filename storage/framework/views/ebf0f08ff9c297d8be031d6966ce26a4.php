<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'contained' => false,
    'label' => null,
    'vertical' => false,
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
    'contained' => false,
    'label' => null,
    'vertical' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<nav
    <?php echo e($attributes
            ->merge([
                'aria-label' => $label,
                'role' => 'tablist',
            ])
            ->class([
                'fi-tabs',
                'fi-contained' => $contained,
                'fi-vertical' => $vertical,
            ])); ?>

>
    <?php echo e($slot); ?>

</nav>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/tabs/index.blade.php ENDPATH**/ ?>