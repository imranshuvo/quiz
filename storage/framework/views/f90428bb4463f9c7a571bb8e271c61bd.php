<?php
    $fieldWrapperView = $getFieldWrapperView();
    $statePath = $getStatePath();
    $attributes = $attributes
        ->merge([
            'autofocus' => $isAutofocused(),
            'disabled' => $isDisabled(),
            'id' => $getId(),
            'required' => $isRequired() && (! $isConcealed()),
            'wire:loading.attr' => 'disabled',
            $applyStateBindingModifiers('wire:model') => $statePath,
        ], escape: false)
        ->merge($getExtraAttributes(), escape: false)
        ->merge($getExtraInputAttributes(), escape: false)
        ->class([
            'fi-checkbox-input',
            'fi-valid' => ! $errors->has($statePath),
            'fi-invalid' => $errors->has($statePath),
        ]);
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
            <input type="checkbox" <?php echo e($attributes); ?> />
         <?php $__env->endSlot(); ?>
    <?php else: ?>
        <input type="checkbox" <?php echo e($attributes); ?> />
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/checkbox.blade.php ENDPATH**/ ?>