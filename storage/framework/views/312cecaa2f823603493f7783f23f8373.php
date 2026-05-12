<?php if (isset($component)) { $__componentOriginalf45da69382bf4ac45a50b496dc82aa9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf45da69382bf4ac45a50b496dc82aa9a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.simple','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page.simple'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php echo e($this->content); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf45da69382bf4ac45a50b496dc82aa9a)): ?>
<?php $attributes = $__attributesOriginalf45da69382bf4ac45a50b496dc82aa9a; ?>
<?php unset($__attributesOriginalf45da69382bf4ac45a50b496dc82aa9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf45da69382bf4ac45a50b496dc82aa9a)): ?>
<?php $component = $__componentOriginalf45da69382bf4ac45a50b496dc82aa9a; ?>
<?php unset($__componentOriginalf45da69382bf4ac45a50b496dc82aa9a); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/pages/simple.blade.php ENDPATH**/ ?>