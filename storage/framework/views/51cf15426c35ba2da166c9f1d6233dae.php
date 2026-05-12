<?php
    use Filament\Forms\Components\Contracts\HasNestedRecursiveValidationRules;
    use Filament\Forms\Components\Field;

    $fieldWrapperView = $getFieldWrapperView();

    $errorMessages = null;
    $errorMessage = null;

    foreach ($getChildComponentContainer()->getComponents() as $childComponent) {
        if (! ($childComponent instanceof Field)) {
            continue;
        }

        $statePath = $childComponent->getStatePath();

        if (blank($statePath)) {
            continue;
        }

        if ($errors->has($statePath)) {
            if ($childComponent->shouldShowAllValidationMessages()) {
                $errorMessages = $errors->get($statePath);
                $shouldShowAllValidationMessages = true;
            } else {
                $errorMessage = $errors->first($statePath);
            }

            $areHtmlValidationMessagesAllowed = $childComponent->areHtmlValidationMessagesAllowed();

            break;
        }

        if (! ($childComponent instanceof HasNestedRecursiveValidationRules)) {
            continue;
        }

        if ($errors->has("{$statePath}.*")) {
            if ($childComponent->shouldShowAllValidationMessages()) {
                $errorMessages = $errors->get("{$statePath}.*");
                $shouldShowAllValidationMessages = true;
            } else {
                $errorMessage = $errors->first("{$statePath}.*");
            }

            $areHtmlValidationMessagesAllowed = $childComponent->areHtmlValidationMessagesAllowed();

            break;
        }
    }
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
<?php $component->withAttributes(['error-message' => $errorMessage,'error-messages' => $errorMessages,'are-html-error-messages-allowed' => $areHtmlValidationMessagesAllowed ?? false,'should-show-all-validation-messages' => $shouldShowAllValidationMessages ?? false,'field' => $schemaComponent]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div
        <?php echo e($attributes
                ->merge([
                    'id' => $getId(),
                ], escape: false)
                ->merge($getExtraAttributes(), escape: false)
                ->class(['fi-sc-fused-group'])); ?>

    >
        <?php echo e($getChildSchema()); ?>

    </div>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/fused-group.blade.php ENDPATH**/ ?>