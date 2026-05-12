

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'accent' => true,
    'size' => 'base',
    'label' => null,
    'icon' => null,
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
    'accent' => true,
    'size' => 'base',
    'label' => null,
    'icon' => null,
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
    ->add('flex relative items-center font-medium justify-center gap-2 whitespace-nowrap')
    ->add(match ($size) {
        'base' => 'h-10 text-sm rounded-lg px-4 [&:has(>:not(span):first-child)]:ps-3 [&:has(>:not(span):last-child)]:pe-3',
        'sm' => 'h-8 text-sm rounded-md px-3',
        'xs' => 'h-6 text-xs rounded-md px-2',
    })
    ->add(match ($size) {
        'base' => 'shadow-xs',
        'sm' => 'shadow-xs',
        'xs' => 'shadow-none',
    })
    ->add('text-zinc-800 dark:text-white')
    ->add('bg-white dark:bg-zinc-700')
    ->add('after:absolute after:-inset-px after:rounded-lg')
    ->add('border border-zinc-200 border-b-zinc-300/80 dark:border-zinc-600')
    ->add([
        '[--haze:color-mix(in_oklab,_var(--color-accent-content),_transparent_97.5%)]',
        '[--haze-border:color-mix(in_oklab,_var(--color-accent-content),_transparent_80%)]',
        '[--haze-light:color-mix(in_oklab,_var(--color-accent),_transparent_98%)]',
        'dark:[--haze:color-mix(in_oklab,_var(--color-accent-content),_transparent_90%)]',
    ])
    ->add(match ($accent) {
        true => [
            'hover:border-[var(--haze-border)] dark:hover:border-zinc-500',
            'dark:data-checked:bg-white/15 data-checked:border-(--color-accent) hover:data-checked:border-(--color-accent)',
            'hover:after:bg-[var(--haze-light)] dark:hover:after:bg-white/[4%] data-checked:after:bg-(--haze) hover:data-checked:after:bg-(--haze)',
        ],
        false => [
            'hover:border-zinc-200 dark:hover:border-zinc-500',
            'data-checked:bg-zinc-50 dark:data-checked:bg-white/15 data-checked:border-zinc-800 dark:data-checked:border-white',
            'hover:bg-zinc-50 dark:hover:bg-zinc-600/75',
        ],
    })
    ->add('disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none')
    ;

$iconAttributes = Flux::attributesAfter('icon:', $attributes, [
    'class' => 'text-zinc-300 dark:text-zinc-400 in-data-checked:text-zinc-800 dark:in-data-checked:text-white',
    'variant' => 'micro',
]);
?>




<ui-checkbox <?php echo e($attributes->class($classes)); ?> data-flux-control data-flux-checkbox-buttons tabindex="-1" data-flux-field>
    <?php if (is_string($icon) && $icon !== ''): ?>
        <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['icon' => $icon,'attributes' => $iconAttributes]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconAttributes)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
    <?php elseif ($icon): ?>
        <?php echo e($icon); ?>

    <?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slot->isNotEmpty() || isset($label)): ?>
        <span><?php echo e($slot->isNotEmpty() ? $slot : $label); ?></span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</ui-checkbox>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/checkbox/variants/buttons.blade.php ENDPATH**/ ?>