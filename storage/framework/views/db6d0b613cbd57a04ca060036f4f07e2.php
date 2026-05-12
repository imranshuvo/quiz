<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'alpineValid' => null,
    'valid' => true,
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
    'alpineValid' => null,
    'valid' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $hasAlpineValidClasses = filled($alpineValid);
?>

<input
    type="checkbox"
    <?php if($hasAlpineValidClasses): ?>
        x-bind:class="{
            'fi-valid': <?php echo e($alpineValid); ?>,
            'fi-invalid': <?php echo e("(! {$alpineValid})"); ?>,
        }"
    <?php endif; ?>
    <?php echo e($attributes
            ->class([
                'fi-checkbox-input',
                'fi-valid' => (! $hasAlpineValidClasses) && $valid,
                'fi-invalid' => (! $hasAlpineValidClasses) && (! $valid),
            ])); ?>

/>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/input/checkbox.blade.php ENDPATH**/ ?>