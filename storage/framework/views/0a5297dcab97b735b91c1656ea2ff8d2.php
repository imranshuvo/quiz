<?php
    $id = $getId();
    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributeBag = $getExtraAttributeBag();
    $key = $getKey();
    $label = $getLabel();
    $statePath = $getStatePath();
    $fileAttachmentsMaxSize = $getFileAttachmentsMaxSize();
    $fileAttachmentsAcceptedFileTypes = $getFileAttachmentsAcceptedFileTypes();
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

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDisabled()): ?>
        <div id="<?php echo e($id); ?>" class="fi-fo-markdown-editor fi-disabled fi-prose">
            <?php echo str($getState())->markdown($getCommonMarkOptions(), $getCommonMarkExtensions())->sanitizeHtml(); ?>

        </div>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['valid' => ! $errors->has($statePath),'attributes' => 
                \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                    ->class(['fi-fo-markdown-editor'])
            ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                \Filament\Support\prepare_inherited_attributes($extraAttributeBag)
                    ->class(['fi-fo-markdown-editor'])
            )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <div
                aria-labelledby="<?php echo e($id); ?>-label"
                id="<?php echo e($id); ?>"
                role="group"
                x-load
                x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('markdown-editor', 'filament/forms')); ?>"
                x-data="markdownEditorFormComponent({
                            canAttachFiles: <?php echo \Illuminate\Support\Js::from($hasFileAttachments())->toHtml() ?>,
                            isLiveDebounced: <?php echo \Illuminate\Support\Js::from($isLiveDebounced())->toHtml() ?>,
                            isLiveOnBlur: <?php echo \Illuminate\Support\Js::from($isLiveOnBlur())->toHtml() ?>,
                            label: <?php echo \Illuminate\Support\Js::from($label)->toHtml() ?>,
                            liveDebounce: <?php echo \Illuminate\Support\Js::from($getNormalizedLiveDebounce())->toHtml() ?>,
                            maxHeight: <?php echo \Illuminate\Support\Js::from($getMaxHeight())->toHtml() ?>,
                            minHeight: <?php echo \Illuminate\Support\Js::from($getMinHeight())->toHtml() ?>,
                            placeholder: <?php echo \Illuminate\Support\Js::from($getPlaceholder())->toHtml() ?>,
                            state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$statePath}')", isOptimisticallyLive: false)); ?>,
                            toolbarButtons: <?php echo \Illuminate\Support\Js::from($getToolbarButtons())->toHtml() ?>,
                            translations: <?php echo \Illuminate\Support\Js::from(__('filament-forms::components.markdown_editor'))->toHtml() ?>,
                            uploadFileAttachmentUsing: async (file, onSuccess, onError) => {
                                const acceptedTypes = <?php echo \Illuminate\Support\Js::from($fileAttachmentsAcceptedFileTypes)->toHtml() ?>

                                if (acceptedTypes && ! acceptedTypes.includes(file.type)) {
                                    return onError(<?php echo \Illuminate\Support\Js::from($fileAttachmentsAcceptedFileTypes ? __('filament-forms::components.markdown_editor.file_attachments_accepted_file_types_message', ['values' => implode(', ', $fileAttachmentsAcceptedFileTypes)]) : null)->toHtml() ?>)
                                }

                                const maxSize = <?php echo \Illuminate\Support\Js::from($fileAttachmentsMaxSize)->toHtml() ?>

                                if (maxSize && file.size > +maxSize * 1024) {
                                    return onError(<?php echo \Illuminate\Support\Js::from($fileAttachmentsMaxSize ? trans_choice('filament-forms::components.markdown_editor.file_attachments_max_size_message', $fileAttachmentsMaxSize, ['max' => $fileAttachmentsMaxSize]) : null)->toHtml() ?>)
                                }

                                $wire.upload(`componentFileAttachments.<?php echo e($statePath); ?>`, file, () => {
                                    $wire
                                        .callSchemaComponentMethod(
                                            '<?php echo e($key); ?>',
                                            'saveUploadedFileAttachmentAndGetUrl',
                                        )
                                        .then((url) => {
                                            if (! url) {
                                                return onError()
                                            }

                                            onSuccess(url)
                                        })
                                })
                            },
                        })"
                wire:ignore
                <?php echo e($getExtraAlpineAttributeBag()); ?>

            >
                <textarea x-ref="editor" x-cloak></textarea>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/markdown-editor.blade.php ENDPATH**/ ?>