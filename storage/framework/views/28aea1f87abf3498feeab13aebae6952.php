

<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php foreach (([ 'indicator' ]) as $__key => $__value) {
    $__consumeVariable = is_string($__key) ? $__key : $__value;
    $$__consumeVariable = is_string($__key) ? $__env->getConsumableComponentData($__key, $__value) : $__env->getConsumableComponentData($__value);
} ?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'iconVariant' => 'micro',
    'description' => null,
    'indicator' => true,
    'accent' => true,
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
    'iconVariant' => 'micro',
    'description' => null,
    'indicator' => true,
    'accent' => true,
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

$iconClasses = Flux::classes()
    ->add('inline-block mt-0.5 text-zinc-400 [ui-checkbox[data-checked]_&]:text-zinc-800 dark:[ui-checkbox[data-checked]_&]:text-white')
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-4' : '')
    ;

$classes = Flux::classes()
    ->add('relative flex justify-between gap-3 flex-1 p-4')
    ->add('rounded-lg shadow-xs')
    ->add('bg-white dark:bg-white/10 dark:hover:bg-white/15 dark:data-checked:bg-white/15')
    ->add('after:absolute after:-inset-px after:rounded-lg')
    ->add('border border-zinc-800/15 dark:border-white/10')
    ->add([
        '[--haze:color-mix(in_oklab,_var(--color-accent-content),_transparent_97.5%)]',
        '[--haze-border:color-mix(in_oklab,_var(--color-accent-content),_transparent_80%)]',
        '[--haze-light:color-mix(in_oklab,_var(--color-accent),_transparent_98%)]',
        'dark:[--haze:color-mix(in_oklab,_var(--color-accent-content),_transparent_90%)]',
    ])
    ->add(match ($accent) {
        true => [
            '[&:hover_[data-flux-checkbox-indicator]]:border-[var(--haze-border)] dark:[&:hover_[data-flux-checkbox-indicator]]:border-white/10',
            'hover:border-[var(--haze-border)] dark:hover:border-white/10',

            'data-checked:border-(--color-accent) hover:data-checked:border-(--color-accent) dark:data-checked:bg-white/15 ',
            'hover:after:bg-[var(--haze-light)] dark:hover:after:bg-white/[4%] data-checked:after:bg-(--haze) hover:data-checked:after:bg-(--haze)',
        ],
        false => [
            'data-checked:bg-zinc-50 dark:data-checked:bg-white/15 data-checked:border-zinc-800 dark:data-checked:border-white',
            'hover:bg-zinc-50 dark:hover:bg-white/15',
        ],
    })
    ->add('[&[disabled]]:opacity-50 dark:[&[disabled]]:opacity-75 [&[disabled]]:cursor-default [&[disabled]]:pointer-events-none')
    ;
?>




<ui-checkbox <?php echo e($attributes->class($classes)); ?> data-flux-control data-flux-checkbox-cards tabindex="-1" data-flux-field>
    <?php if ($label): ?>
        <div class="flex-1 flex gap-2">
            <?php if (is_string($icon) && $icon !== ''): ?>
                <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconVariant),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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

            <div class="flex-1">
                <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($slot->isNotEmpty() ? $slot : $label); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>

                <?php if ($description): ?>
                    <?php if (isset($component)) { $__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::subheading','data' => ['size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::subheading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($description); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97)): ?>
<?php $attributes = $__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97; ?>
<?php unset($__attributesOriginal43e8c568bbb8b06b9124aad3ccf4ec97); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97)): ?>
<?php $component = $__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97; ?>
<?php unset($__componentOriginal43e8c568bbb8b06b9124aad3ccf4ec97); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginal132809635db4ae0903491272a3f385e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal132809635db4ae0903491272a3f385e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::checkbox.indicator','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::checkbox.indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal132809635db4ae0903491272a3f385e8)): ?>
<?php $attributes = $__attributesOriginal132809635db4ae0903491272a3f385e8; ?>
<?php unset($__attributesOriginal132809635db4ae0903491272a3f385e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal132809635db4ae0903491272a3f385e8)): ?>
<?php $component = $__componentOriginal132809635db4ae0903491272a3f385e8; ?>
<?php unset($__componentOriginal132809635db4ae0903491272a3f385e8); ?>
<?php endif; ?>
    <?php else: ?>
        <?php echo e($slot); ?>

    <?php endif; ?>
</ui-checkbox>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/checkbox/variants/cards.blade.php ENDPATH**/ ?>