<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'field' => null,
    'id' => null,
    'label' => null,
    'labelTag' => 'label',
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
    'field' => null,
    'id' => null,
    'label' => null,
    'labelTag' => 'label',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use Illuminate\View\ComponentAttributeBag;

    if ($field) {
        $id ??= $field->getId();
        $label ??= $field->getLabel();
    }
?>

<div
    data-field-wrapper
    <?php echo e((new ComponentAttributeBag)
            ->merge($field?->getExtraFieldWrapperAttributes() ?? [], escape: false)
            ->class([
                'fi-fo-field',
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($label)): ?>
        <<?php echo e($labelTag); ?>

            <?php if($labelTag === 'label'): ?>
                for="<?php echo e($id); ?>"
            <?php else: ?>
                id="<?php echo e($id); ?>-label"
            <?php endif; ?>
            class="fi-fo-field-label fi-sr-only"
        >
            <?php echo e($label); ?>

        </<?php echo e($labelTag); ?>>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/plain-field-wrapper.blade.php ENDPATH**/ ?>