<?php
    use Filament\Forms\Components\TableSelect\Livewire\TableSelectLivewireComponent;

    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributes = $getExtraAttributes();
    $id = $getId();
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
<?php $component->withAttributes(['field' => $field]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div
        <?php echo e($attributes
                ->merge([
                    'id' => $id,
                ], escape: false)
                ->merge($extraAttributes, escape: false)); ?>

    >
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(TableSelectLivewireComponent::class, [
            'isDisabled' => $isDisabled(),
            'maxSelectableRecords' => $getMaxItems(),
            'model' => $getModel(),
            'record' => $getRecord(),
            'relationshipName' => $getRelationshipName(),
            'shouldIgnoreRelatedRecords' => $shouldIgnoreRelatedRecords(),
            'tableConfiguration' => base64_encode($getTableConfiguration()),
            'tableArguments' => $getTableArguments(),
            $applyStateBindingModifiers('wire:model') => $getStatePath(),
        ]);

$__keyOuter = $__key ?? null;

$__key = $getLivewireKey();
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2216552976-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/table-select.blade.php ENDPATH**/ ?>