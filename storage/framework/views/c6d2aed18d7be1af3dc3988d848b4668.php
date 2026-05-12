<?php
    use Filament\Support\Enums\IconSize;
    use Filament\Support\View\Components\SectionComponent\IconComponent;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'compact' => false,
    'contained' => true,
    'description' => null,
    'footer' => null,
    'heading',
    'headingTag' => 'h2',
    'icon' => null,
    'iconColor' => 'primary',
    'iconSize' => null,
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
    'compact' => false,
    'contained' => true,
    'description' => null,
    'footer' => null,
    'heading',
    'headingTag' => 'h2',
    'icon' => null,
    'iconColor' => 'primary',
    'iconSize' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    if (filled($iconSize) && (! $iconSize instanceof IconSize)) {
        $iconSize = IconSize::tryFrom($iconSize) ?? $iconSize;
    }

    $hasDescription = filled((string) $description);
    $hasIcon = filled($icon);
?>

<section
    <?php echo e($attributes->class([
            'fi-empty-state',
            'fi-compact' => $compact,
            'fi-empty-state-not-contained' => ! $contained,
        ])); ?>

>
    <div class="fi-empty-state-content">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasIcon): ?>
            <div
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-empty-state-icon-bg',
                    'fi-color ' . ('fi-color-' . $iconColor) => $iconColor !== 'gray',
                ]); ?>"
            >
                <?php echo e(\Filament\Support\generate_icon_html($icon, attributes: (new \Illuminate\View\ComponentAttributeBag)
                        ->color(IconComponent::class, $iconColor), size: $iconSize ?? IconSize::Large)); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="fi-empty-state-text-ctn">
            <<?php echo e($headingTag); ?> class="fi-empty-state-heading">
                <?php echo e($heading); ?>

            </<?php echo e($headingTag); ?>>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDescription): ?>
                <p class="fi-empty-state-description">
                    <?php echo e($description); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <footer class="fi-empty-state-footer">
                <?php echo e($footer); ?>

            </footer>
        </div>
    </div>
</section>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/empty-state.blade.php ENDPATH**/ ?>