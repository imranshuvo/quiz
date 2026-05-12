<?php
    $description = $getDescription();
    $footer = $getChildSchema($schemaComponent::FOOTER_SCHEMA_KEY)?->toHtmlString();
    $heading = $getHeading();
    $headingTag = $getHeadingTag();
    $icon = $getIcon();
    $iconColor = $getIconColor();
    $iconSize = $getIconSize();
    $isCompact = $isCompact();
    $isContained = $isContained();
?>

<div
    <?php echo e($attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class(['fi-sc-empty-state'])); ?>

>
    <?php if (isset($component)) { $__componentOriginal18b7d5277b8ac8ab91a5868675cf72d4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18b7d5277b8ac8ab91a5868675cf72d4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.empty-state','data' => ['compact' => $isCompact,'contained' => $isContained,'description' => $description,'footer' => $footer,'heading' => $heading,'headingTag' => $headingTag,'icon' => $icon,'iconColor' => $iconColor,'iconSize' => $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['compact' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isCompact),'contained' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isContained),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description),'footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($footer),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'heading-tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headingTag),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconColor),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18b7d5277b8ac8ab91a5868675cf72d4)): ?>
<?php $attributes = $__attributesOriginal18b7d5277b8ac8ab91a5868675cf72d4; ?>
<?php unset($__attributesOriginal18b7d5277b8ac8ab91a5868675cf72d4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18b7d5277b8ac8ab91a5868675cf72d4)): ?>
<?php $component = $__componentOriginal18b7d5277b8ac8ab91a5868675cf72d4; ?>
<?php unset($__componentOriginal18b7d5277b8ac8ab91a5868675cf72d4); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/empty-state.blade.php ENDPATH**/ ?>