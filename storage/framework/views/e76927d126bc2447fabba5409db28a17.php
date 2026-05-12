<?php
    use Filament\Support\Enums\IconSize;
    use Filament\Support\View\Components\DropdownComponent\HeaderComponent;
    use Illuminate\View\ComponentAttributeBag;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'color' => 'gray',
    'icon' => null,
    'iconSize' => null,
    'tag' => 'div',
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
    'color' => 'gray',
    'icon' => null,
    'iconSize' => null,
    'tag' => 'div',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    if (! ($iconSize instanceof IconSize)) {
        $iconSize = filled($iconSize) ? (IconSize::tryFrom($iconSize) ?? $iconSize) : null;
    }
?>

<<?php echo e($tag); ?>

    <?php echo e($attributes
            ->class([
                'fi-dropdown-header',
            ])
            ->color(HeaderComponent::class, $color)); ?>

>
    <?php echo e(\Filament\Support\generate_icon_html($icon, size: $iconSize)); ?>


    <span>
        <?php echo e($slot); ?>

    </span>
</<?php echo e($tag); ?>>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/dropdown/header.blade.php ENDPATH**/ ?>