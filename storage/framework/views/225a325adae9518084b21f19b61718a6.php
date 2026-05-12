<?php
    use Filament\Support\Enums\IconSize;

    $controls = $getChildSchema($schemaComponent::CONTROLS_SCHEMA_KEY)?->toHtmlString();
    $extraAttributeBag = $getExtraAttributeBag();
    $footer = $getChildSchema($schemaComponent::FOOTER_SCHEMA_KEY)?->toHtmlString();
    $color = $getColor();
    $description = $getDescription();
    $heading = $getHeading();
    $icon = $getIcon();
    $iconColor = $getIconColor();
    $iconSize = $getIconSize() ?? IconSize::Large;
?>

<?php if (isset($component)) { $__componentOriginalc1865fced28501235cfee36c0ed9ea44 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1865fced28501235cfee36c0ed9ea44 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.callout','data' => ['attributes' => 
        \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
            ->class(['fi-sc-callout'])
    ,'color' => $color ?? 'gray','description' => $description,'heading' => $heading,'icon' => $icon,'iconColor' => $iconColor,'iconSize' => $iconSize]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::callout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
        \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
            ->class(['fi-sc-callout'])
    ),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color ?? 'gray'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconColor),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

     <?php $__env->slot('footer', null, []); ?> 
        <?php echo e($footer); ?>

     <?php $__env->endSlot(); ?>

     <?php $__env->slot('controls', null, []); ?> 
        <?php echo e($controls); ?>

     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1865fced28501235cfee36c0ed9ea44)): ?>
<?php $attributes = $__attributesOriginalc1865fced28501235cfee36c0ed9ea44; ?>
<?php unset($__attributesOriginalc1865fced28501235cfee36c0ed9ea44); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1865fced28501235cfee36c0ed9ea44)): ?>
<?php $component = $__componentOriginalc1865fced28501235cfee36c0ed9ea44; ?>
<?php unset($__componentOriginalc1865fced28501235cfee36c0ed9ea44); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/callout.blade.php ENDPATH**/ ?>