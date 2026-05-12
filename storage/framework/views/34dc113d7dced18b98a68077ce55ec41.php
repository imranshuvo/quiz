<?php
    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributeBag = $getExtraAttributeBag();
    $isDisabled = $isDisabled();
    $isLive = $isLive();
    $isLiveOnBlur = $isLiveOnBlur();
    $isLiveDebounced = $isLiveDebounced();
    $liveDebounce = $getLiveDebounce();
    $key = $getKey();
    $language = $getLanguage();
    $statePath = $getStatePath();
    $livewireKey = $getLivewireKey();
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

    <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['disabled' => $isDisabled,'valid' => ! $errors->has($statePath),'attributes' => 
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class(['fi-fo-code-editor'])
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class(['fi-fo-code-editor'])
        )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div
            x-load
            x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('code-editor', 'filament/forms')); ?>"
            x-data="codeEditorFormComponent({
                        canWrap: <?php echo \Illuminate\Support\Js::from($canWrap())->toHtml() ?>,
                        isDisabled: <?php echo \Illuminate\Support\Js::from($isDisabled)->toHtml() ?>,
                        isLive: <?php echo \Illuminate\Support\Js::from($isLive)->toHtml() ?>,
                        isLiveDebounced: <?php echo \Illuminate\Support\Js::from($isLiveDebounced)->toHtml() ?>,
                        isLiveOnBlur: <?php echo \Illuminate\Support\Js::from($isLiveOnBlur)->toHtml() ?>,
                        liveDebounce: <?php echo \Illuminate\Support\Js::from($liveDebounce)->toHtml() ?>,
                        language: <?php echo \Illuminate\Support\Js::from($language?->value)->toHtml() ?>,
                        state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$statePath}')", isOptimisticallyLive: false)); ?>,
                    })"
            wire:ignore
            <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.'.e(substr(md5(serialize([
                    $isDisabled,
                    $language?->value,
                ])), 0, 64)).''; ?>wire:key="<?php echo e($livewireKey); ?>.<?php echo e(substr(md5(serialize([
                    $isDisabled,
                    $language?->value,
                ])), 0, 64)); ?>"
            <?php echo e($getExtraAlpineAttributeBag()); ?>

        >
            <div x-ref="editor" x-cloak></div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $attributes = $__attributesOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__attributesOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $component = $__componentOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__componentOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/code-editor.blade.php ENDPATH**/ ?>