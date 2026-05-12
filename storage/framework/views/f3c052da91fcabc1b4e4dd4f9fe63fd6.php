<?php
    $fieldWrapperView = $getFieldWrapperView();
    $isVertical = $isVertical();
    $pipsMode = $getPipsMode();
    $livewireKey = $getLivewireKey();
    $isDisabled = $isDisabled();
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

    <div
        x-load
        x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('slider', 'filament/forms')); ?>"
        x-data="sliderFormComponent({
                    arePipsStepped: <?php echo \Illuminate\Support\Js::from($arePipsStepped())->toHtml() ?>,
                    behavior: <?php echo \Illuminate\Support\Js::from($getBehaviorForJs())->toHtml() ?>,
                    decimalPlaces: <?php echo \Illuminate\Support\Js::from($getDecimalPlaces())->toHtml() ?>,
                    fillTrack: <?php echo \Illuminate\Support\Js::from($getFillTrack())->toHtml() ?>,
                    isDisabled: <?php echo \Illuminate\Support\Js::from($isDisabled)->toHtml() ?>,
                    isRtl: <?php echo \Illuminate\Support\Js::from($isRtl())->toHtml() ?>,
                    isVertical: <?php echo \Illuminate\Support\Js::from($isVertical)->toHtml() ?>,
                    maxDifference: <?php echo \Illuminate\Support\Js::from($getMaxDifference())->toHtml() ?>,
                    minDifference: <?php echo \Illuminate\Support\Js::from($getMinDifference())->toHtml() ?>,
                    maxValue: <?php echo \Illuminate\Support\Js::from($getMaxValue())->toHtml() ?>,
                    minValue: <?php echo \Illuminate\Support\Js::from($getMinValue())->toHtml() ?>,
                    nonLinearPoints: <?php echo \Illuminate\Support\Js::from($getNonLinearPoints())->toHtml() ?>,
                    pipsDensity: <?php echo \Illuminate\Support\Js::from($getPipsDensity())->toHtml() ?>,
                    pipsFilter: <?php echo \Illuminate\Support\Js::from($getPipsFilterForJs())->toHtml() ?>,
                    pipsFormatter: <?php echo \Illuminate\Support\Js::from($getPipsFormatterForJs())->toHtml() ?>,
                    pipsMode: <?php echo \Illuminate\Support\Js::from($pipsMode)->toHtml() ?>,
                    pipsValues: <?php echo \Illuminate\Support\Js::from($getPipsValues())->toHtml() ?>,
                    rangePadding: <?php echo \Illuminate\Support\Js::from($getRangePadding())->toHtml() ?>,
                    state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$getStatePath()}')")); ?>,
                    step: <?php echo \Illuminate\Support\Js::from($getStep())->toHtml() ?>,
                    tooltips: <?php echo \Illuminate\Support\Js::from($getTooltipsForJs())->toHtml() ?>,
                })"
        wire:ignore
        <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = ''.e($livewireKey).'.'.e(substr(md5(serialize([
                $isDisabled,
            ])), 0, 64)).''; ?>wire:key="<?php echo e($livewireKey); ?>.<?php echo e(substr(md5(serialize([
                $isDisabled,
            ])), 0, 64)); ?>"
        <?php echo e($attributes
                ->merge([
                    'id' => $getId(),
                ], escape: false)
                ->merge($getExtraAttributes(), escape: false)
                ->merge($getExtraAlpineAttributes(), escape: false)
                ->class([
                    'fi-fo-slider',
                    'fi-fo-slider-has-pips' => $pipsMode,
                    'fi-fo-slider-has-tooltips' => $hasTooltips(),
                    'fi-fo-slider-vertical' => $isVertical,
                ])); ?>

    ></div>
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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/slider.blade.php ENDPATH**/ ?>