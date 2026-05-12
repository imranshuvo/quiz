<?php
    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributeBag = $getExtraAttributeBag();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $rows = $getRows();
    $placeholder = $getPlaceholder();
    $shouldAutosize = $shouldAutosize();
    $placeholder = $getPlaceholder();
    $statePath = $getStatePath();

    $initialHeight = (($rows ?? 2) * 1.5) + 0.75;
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
<?php $component->withAttributes(['field' => $field,'class' => 'fi-fo-textarea-wrp']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['disabled' => $isDisabled,'valid' => ! $errors->has($statePath),'attributes' => 
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class([
                    'fi-fo-textarea',
                    'fi-autosizable' => $shouldAutosize,
                ])
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                ->class([
                    'fi-fo-textarea',
                    'fi-autosizable' => $shouldAutosize,
                ])
        )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div wire:ignore.self style="height: '<?php echo e($initialHeight . 'rem'); ?>'">
            <textarea
                x-load
                x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('textarea', 'filament/forms')); ?>"
                x-data="textareaFormComponent({
                            initialHeight: <?php echo \Illuminate\Support\Js::from($initialHeight)->toHtml() ?>,
                            shouldAutosize: <?php echo \Illuminate\Support\Js::from($shouldAutosize)->toHtml() ?>,
                            state: $wire.$entangle('<?php echo e($statePath); ?>'),
                        })"
                <?php if($shouldAutosize): ?>
                    x-intersect.once="resize()"
                    x-on:resize.window="resize()"
                <?php endif; ?>
                x-model="state"
                <?php if($isGrammarlyDisabled()): ?>
                    data-gramm="false"
                    data-gramm_editor="false"
                    data-enable-grammarly="false"
                <?php endif; ?>
                <?php echo e($getExtraAlpineAttributeBag()); ?>

                <?php echo e($getExtraInputAttributeBag()
                        ->merge([
                            'autocomplete' => $getAutocomplete(),
                            'autofocus' => $isAutofocused(),
                            'cols' => $getCols(),
                            'disabled' => $isDisabled,
                            'id' => $getId(),
                            'maxlength' => (! $isConcealed) ? $getMaxLength() : null,
                            'minlength' => (! $isConcealed) ? $getMinLength() : null,
                            'placeholder' => filled($placeholder) ? e($placeholder) : null,
                            'readonly' => $isReadOnly(),
                            'required' => $isRequired() && (! $isConcealed),
                            'rows' => $rows,
                            $applyStateBindingModifiers('wire:model') => $statePath,
                        ], escape: false)); ?>

            ></textarea>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/textarea.blade.php ENDPATH**/ ?>