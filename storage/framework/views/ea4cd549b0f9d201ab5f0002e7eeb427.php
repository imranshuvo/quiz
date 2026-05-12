<?php
    use Illuminate\View\ComponentAttributeBag;

    $fieldWrapperView = $getFieldWrapperView();
    $statePath = $getStatePath();

    $attributes = (new ComponentAttributeBag)
        ->merge([
            'aria-checked' => 'false',
            'autofocus' => $isAutofocused(),
            'disabled' => $isDisabled(),
            'id' => $getId(),
            'offColor' => $getOffColor() ?? 'gray',
            'offIcon' => $getOffIcon(),
            'onColor' => $getOnColor() ?? 'primary',
            'onIcon' => $getOnIcon(),
            'state' => '$wire.' . $applyStateBindingModifiers('$entangle(\'' . $statePath . '\')'),
            'wire:loading.attr' => 'disabled',
            'wire:target' => $statePath,
        ], escape: false)
        ->merge($getExtraAttributes(), escape: false)
        ->merge($getExtraAlpineAttributes(), escape: false)
        ->class(['fi-fo-toggle']);
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $fieldWrapperView] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field,'inline-label-vertical-alignment' => \Filament\Support\Enums\VerticalAlignment::Center]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isInline()): ?>
         <?php $__env->slot('labelPrefix', null, []); ?> 
            <?php if (isset($component)) { $__componentOriginal36e35bdd70f75167ca3607ce632b2f1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.toggle','data' => ['attributes' => \Filament\Support\prepare_inherited_attributes($attributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($attributes))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b)): ?>
<?php $attributes = $__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b; ?>
<?php unset($__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36e35bdd70f75167ca3607ce632b2f1b)): ?>
<?php $component = $__componentOriginal36e35bdd70f75167ca3607ce632b2f1b; ?>
<?php unset($__componentOriginal36e35bdd70f75167ca3607ce632b2f1b); ?>
<?php endif; ?>
         <?php $__env->endSlot(); ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal36e35bdd70f75167ca3607ce632b2f1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.toggle','data' => ['attributes' => \Filament\Support\prepare_inherited_attributes($attributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($attributes))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b)): ?>
<?php $attributes = $__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b; ?>
<?php unset($__attributesOriginal36e35bdd70f75167ca3607ce632b2f1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36e35bdd70f75167ca3607ce632b2f1b)): ?>
<?php $component = $__componentOriginal36e35bdd70f75167ca3607ce632b2f1b; ?>
<?php unset($__componentOriginal36e35bdd70f75167ca3607ce632b2f1b); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/toggle.blade.php ENDPATH**/ ?>