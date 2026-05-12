<?php
    $extraAttributes = $getExtraAttributes();
    $id = $getId();
    $isLabelHidden = $isLabelHidden();
    $label = $getLabel();
    $isContained = $isContained();
?>

<?php if (isset($component)) { $__componentOriginal44a508883f9207a939367952373b4021 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal44a508883f9207a939367952373b4021 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.fieldset','data' => ['contained' => $isContained,'label' => $label,'labelHidden' => $isLabelHidden,'required' => isset($isMarkedAsRequired) ? $isMarkedAsRequired() : false,'attributes' => 
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->merge([
                'id' => $id,
            ], escape: false)
            ->merge($extraAttributes, escape: false)
            ->class(['fi-sc-fieldset'])
    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::fieldset'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['contained' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isContained),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'label-hidden' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isLabelHidden),'required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($isMarkedAsRequired) ? $isMarkedAsRequired() : false),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->merge([
                'id' => $id,
            ], escape: false)
            ->merge($extraAttributes, escape: false)
            ->class(['fi-sc-fieldset'])
    )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php echo e($getChildSchema()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal44a508883f9207a939367952373b4021)): ?>
<?php $attributes = $__attributesOriginal44a508883f9207a939367952373b4021; ?>
<?php unset($__attributesOriginal44a508883f9207a939367952373b4021); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal44a508883f9207a939367952373b4021)): ?>
<?php $component = $__componentOriginal44a508883f9207a939367952373b4021; ?>
<?php unset($__componentOriginal44a508883f9207a939367952373b4021); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/fieldset.blade.php ENDPATH**/ ?>