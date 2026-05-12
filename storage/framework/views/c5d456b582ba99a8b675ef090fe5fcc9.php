<?php
    use Filament\Support\Enums\GridDirection;

    $fieldWrapperView = $getFieldWrapperView();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $isHtmlAllowed = $isHtmlAllowed();
    $gridDirection = $getGridDirection() ?? GridDirection::Column;
    $isBulkToggleable = $isBulkToggleable();
    $isDisabled = $isDisabled();
    $isSearchable = $isSearchable();
    $statePath = $getStatePath();
    $options = $getOptions();
    $livewireKey = $getLivewireKey();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
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
        x-load
        x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('checkbox-list', 'filament/forms')); ?>"
        x-data="checkboxListFormComponent({
                    livewireId: <?php echo \Illuminate\Support\Js::from($this->getId())->toHtml() ?>,
                })"
        <?php echo e($getExtraAlpineAttributeBag()->class(['fi-fo-checkbox-list'])); ?>

    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isDisabled): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSearchable): ?>
                <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['inlinePrefix' => true,'prefixIcon' => \Filament\Support\Icons\Heroicon::MagnifyingGlass,'prefixIconAlias' => \Filament\Forms\View\FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD,'class' => 'fi-fo-checkbox-list-search-input-wrp']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['inline-prefix' => true,'prefix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::MagnifyingGlass),'prefix-icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Forms\View\FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD),'class' => 'fi-fo-checkbox-list-search-input-wrp']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <input
                        placeholder="<?php echo e($getSearchPrompt()); ?>"
                        type="search"
                        x-model.debounce.<?php echo e($getSearchDebounce()); ?>="search"
                        class="fi-input fi-input-has-inline-prefix"
                    />
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isBulkToggleable && count($options)): ?>
                <div
                    x-cloak
                    class="fi-fo-checkbox-list-actions"
                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.actions'; ?>wire:key="<?php echo e($livewireKey); ?>.actions"
                >
                    <span
                        x-show="! areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.actions.select-all'; ?>wire:key="<?php echo e($livewireKey); ?>.actions.select-all"
                    >
                        <?php echo e($getAction('selectAll')); ?>

                    </span>

                    <span
                        x-show="areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.actions.deselect-all'; ?>wire:key="<?php echo e($livewireKey); ?>.actions.deselect-all"
                    >
                        <?php echo e($getAction('deselectAll')); ?>

                    </span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div
            <?php echo e($getExtraAttributeBag()
                    ->grid($getColumns(), $gridDirection)
                    ->merge([
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ], escape: false)
                    ->class([
                        'fi-fo-checkbox-list-options',
                    ])); ?>

        >
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div
                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.options.'.e($value).''; ?>wire:key="<?php echo e($livewireKey); ?>.options.<?php echo e($value); ?>"
                    <?php if($isSearchable): ?>
                        x-show="
                            $el
                                .querySelector('.fi-fo-checkbox-list-option-label')
                                ?.innerText.toLowerCase()
                                .includes(search.toLowerCase()) ||
                                $el
                                    .querySelector('.fi-fo-checkbox-list-option-description')
                                    ?.innerText.toLowerCase()
                                    .includes(search.toLowerCase())
                        "
                    <?php endif; ?>
                    class="fi-fo-checkbox-list-option-ctn"
                >
                    <label class="fi-fo-checkbox-list-option">
                        <input
                            type="checkbox"
                            <?php echo e($extraInputAttributeBag
                                    ->merge([
                                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                        'value' => $value,
                                        'wire:loading.attr' => 'disabled',
                                        $wireModelAttribute => $statePath,
                                        'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                    ], escape: false)
                                    ->class([
                                        'fi-checkbox-input',
                                        'fi-valid' => ! $errors->has($statePath),
                                        'fi-invalid' => $errors->has($statePath),
                                    ])); ?>

                        />

                        <div class="fi-fo-checkbox-list-option-text">
                            <span class="fi-fo-checkbox-list-option-label">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isHtmlAllowed): ?>
                                    <?php echo $label; ?>

                                <?php else: ?>
                                    <?php echo e($label); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDescription($value)): ?>
                                <p
                                    class="fi-fo-checkbox-list-option-description"
                                >
                                    <?php echo e($getDescription($value)); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </label>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.empty'; ?>wire:key="<?php echo e($livewireKey); ?>.empty"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSearchable): ?>
            <div
                x-cloak
                x-show="search && ! visibleCheckboxListOptions.length"
                class="fi-fo-checkbox-list-no-search-results-message"
            >
                <?php echo e($getNoSearchResultsMessage()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/checkbox-list.blade.php ENDPATH**/ ?>