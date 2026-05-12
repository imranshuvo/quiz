<?php
    $fieldWrapperView = $getFieldWrapperView();
    $extraAttributes = $getExtraAttributes();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $color = $getColor() ?? 'primary';
    $id = $getId();
    $isAutofocused = $isAutofocused();
    $isDisabled = $isDisabled();
    $isPrefixInline = $isPrefixInline();
    $isReorderable = (! $isDisabled) && $isReorderable();
    $isSuffixInline = $isSuffixInline();
    $placeholder = $getPlaceholder();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixIconColor = $getPrefixIconColor();
    $prefixLabel = $getPrefixLabel();
    $statePath = $getStatePath();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixIconColor = $getSuffixIconColor();
    $suffixLabel = $getSuffixLabel();
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
<?php $component->withAttributes(['field' => $field,'class' => 'fi-fo-tags-input-wrp']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['disabled' => $isDisabled,'inlinePrefix' => $isPrefixInline,'inlineSuffix' => $isSuffixInline,'prefix' => $prefixLabel,'prefixActions' => $prefixActions,'prefixIcon' => $prefixIcon,'prefixIconColor' => $prefixIconColor,'suffix' => $suffixLabel,'suffixActions' => $suffixActions,'suffixIcon' => $suffixIcon,'suffixIconColor' => $suffixIconColor,'valid' => ! $errors->has($statePath),'xOn:focusInput.stop' => '$el.querySelector(\'input\')?.focus()','attributes' => 
            \Filament\Support\prepare_inherited_attributes($attributes)
                ->merge($extraAttributes, escape: false)
                ->class([
                    'fi-fo-tags-input',
                    'fi-disabled' => $isDisabled,
                ])
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'inline-prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isPrefixInline),'inline-suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSuffixInline),'prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixLabel),'prefix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixActions),'prefix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixIcon),'prefix-icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixIconColor),'suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixLabel),'suffix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixActions),'suffix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixIcon),'suffix-icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixIconColor),'valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'x-on:focus-input.stop' => '$el.querySelector(\'input\')?.focus()','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            \Filament\Support\prepare_inherited_attributes($attributes)
                ->merge($extraAttributes, escape: false)
                ->class([
                    'fi-fo-tags-input',
                    'fi-disabled' => $isDisabled,
                ])
        )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div
            x-load
            x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('tags-input', 'filament/forms')); ?>"
            x-data="tagsInputFormComponent({
                        state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$statePath}')")); ?>,
                        splitKeys: <?php echo \Illuminate\Support\Js::from($getSplitKeys())->toHtml() ?>,
                    })"
            <?php echo e($getExtraAlpineAttributeBag()); ?>

        >
            <input
                <?php echo e($extraInputAttributeBag
                        ->merge([
                            'autocomplete' => 'off',
                            'autofocus' => $isAutofocused,
                            'disabled' => $isDisabled,
                            'id' => $id,
                            'list' => $id . '-suggestions',
                            'placeholder' => filled($placeholder) ? e($placeholder) : null,
                            'type' => 'text',
                            'x-bind' => 'input',
                        ], escape: false)
                        ->class([
                            'fi-input',
                            'fi-input-has-inline-prefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                            'fi-input-has-inline-suffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                        ])); ?>

            />

            <datalist id="<?php echo e($id); ?>-suggestions">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getSuggestions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggestion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <template
                        x-bind:key="<?php echo \Illuminate\Support\Js::from($suggestion)->toHtml() ?>"
                        x-if="! (state?.includes(<?php echo \Illuminate\Support\Js::from($suggestion)->toHtml() ?>) ?? true)"
                    >
                        <option value="<?php echo e($suggestion); ?>" />
                    </template>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </datalist>

            <div wire:ignore>
                <template x-cloak x-if="state?.length">
                    <div
                        <?php if($isReorderable): ?>
                            x-on:end.stop="reorderTags($event)"
                            x-sortable
                            data-sortable-animation-duration="<?php echo e($getReorderAnimationDuration()); ?>"
                        <?php endif; ?>
                        class="fi-fo-tags-input-tags-ctn"
                    >
                        <template
                            x-for="(tag, index) in state"
                            x-bind:key="`${tag}-${index}`"
                        >
                            <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $color,'xBind:xSortableItem' => $isReorderable ? 'index' : null,'xSortableHandle' => $isReorderable ? '' : null,'class' => \Illuminate\Support\Arr::toCssClasses([
                                    'fi-reorderable' => $isReorderable,
                                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'x-bind:x-sortable-item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReorderable ? 'index' : null),'x-sortable-handle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReorderable ? '' : null),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                    'fi-reorderable' => $isReorderable,
                                ]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                <?php echo e($getTagPrefix()); ?>


                                <span x-text="tag"></span>

                                <?php echo e($getTagSuffix()); ?>


                                 <?php $__env->slot('deleteButton', null, ['x-on:click.stop' => 'deleteTag(tag)','x-bind:aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('\'' . __('filament-forms::components.tags_input.actions.delete.label') . ': \' + tag')]); ?>  <?php $__env->endSlot(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
                        </template>
                    </div>
                </template>
            </div>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/tags-input.blade.php ENDPATH**/ ?>