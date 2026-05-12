<?php
    use Filament\Support\View\Components\ToggleComponent;
    use Illuminate\Support\Arr;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'state',
    'offColor' => 'gray',
    'offIcon' => null,
    'onColor' => 'primary',
    'onIcon' => null,
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
    'state',
    'offColor' => 'gray',
    'offIcon' => null,
    'onColor' => 'primary',
    'onIcon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<button
    x-data="{ state: <?php echo e($state); ?> }"
    x-bind:aria-checked="state?.toString()"
    x-on:click="state = ! state"
    x-bind:class="
        state ? <?php echo \Illuminate\Support\Js::from(Arr::toCssClasses([
                    'fi-toggle-on',
                    ...\Filament\Support\get_component_color_classes(ToggleComponent::class, $onColor),
                ]))->toHtml() ?> : <?php echo \Illuminate\Support\Js::from(Arr::toCssClasses([
                            'fi-toggle-off',
                            ...\Filament\Support\get_component_color_classes(ToggleComponent::class, $offColor),
                        ]))->toHtml() ?>
    "
    <?php if($state): ?>
        x-cloak
    <?php endif; ?>
    <?php echo e($attributes
            ->merge([
                'role' => 'switch',
                'type' => 'button',
            ], escape: false)
            ->class(['fi-toggle'])); ?>

>
    <div>
        <div aria-hidden="true">
            <?php echo e(\Filament\Support\generate_icon_html($offIcon, size: \Filament\Support\Enums\IconSize::ExtraSmall)); ?>

        </div>

        <div aria-hidden="true">
            <?php echo e(\Filament\Support\generate_icon_html($onIcon, size: \Filament\Support\Enums\IconSize::ExtraSmall)); ?>

        </div>
    </div>
</button>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($state): ?>
    <div
        x-cloak="inline-flex"
        wire:ignore
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fi-toggle fi-toggle-on fi-hidden',
            ...\Filament\Support\get_component_color_classes(ToggleComponent::class, $onColor),
        ]); ?>"
    >
        <div>
            <div aria-hidden="true"></div>

            <div aria-hidden="true">
                <?php echo e(\Filament\Support\generate_icon_html($onIcon, size: \Filament\Support\Enums\IconSize::ExtraSmall)); ?>

            </div>
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/toggle.blade.php ENDPATH**/ ?>