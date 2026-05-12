

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'iconVariant' => 'mini',
    'size' => null,
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
    'iconVariant' => 'mini',
    'size' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
?>

<?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputCopyable','xOn:click' => 'copy()','xBind:dataCopyableCopied' => 'copied','ariaLabel' => ''.e(__('Copy to clipboard')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size === 'sm' || $size === 'xs' ? 'xs' : 'sm'),'x-data' => 'fluxInputCopyable','x-on:click' => 'copy()','x-bind:data-copyable-copied' => 'copied','aria-label' => ''.e(__('Copy to clipboard')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if (isset($component)) { $__componentOriginald1623caf8352e929ab8330cb6301c6be = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1623caf8352e929ab8330cb6301c6be = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.clipboard-document-check','data' => ['variant' => $iconVariant,'class' => 'hidden [[data-copyable-copied]>&]:block']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.clipboard-document-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconVariant),'class' => 'hidden [[data-copyable-copied]>&]:block']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1623caf8352e929ab8330cb6301c6be)): ?>
<?php $attributes = $__attributesOriginald1623caf8352e929ab8330cb6301c6be; ?>
<?php unset($__attributesOriginald1623caf8352e929ab8330cb6301c6be); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1623caf8352e929ab8330cb6301c6be)): ?>
<?php $component = $__componentOriginald1623caf8352e929ab8330cb6301c6be; ?>
<?php unset($__componentOriginald1623caf8352e929ab8330cb6301c6be); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal4da0fb5c2f91d5abdd541ee46e42b692 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da0fb5c2f91d5abdd541ee46e42b692 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.clipboard-document','data' => ['variant' => $iconVariant,'class' => 'block [[data-copyable-copied]>&]:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.clipboard-document'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconVariant),'class' => 'block [[data-copyable-copied]>&]:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4da0fb5c2f91d5abdd541ee46e42b692)): ?>
<?php $attributes = $__attributesOriginal4da0fb5c2f91d5abdd541ee46e42b692; ?>
<?php unset($__attributesOriginal4da0fb5c2f91d5abdd541ee46e42b692); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4da0fb5c2f91d5abdd541ee46e42b692)): ?>
<?php $component = $__componentOriginal4da0fb5c2f91d5abdd541ee46e42b692; ?>
<?php unset($__componentOriginal4da0fb5c2f91d5abdd541ee46e42b692); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/input/copyable.blade.php ENDPATH**/ ?>