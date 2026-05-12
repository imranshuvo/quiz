<?php
    use Filament\Schemas\View\Components\TextComponent;
    use Filament\Support\Enums\FontFamily;
    use Filament\Support\Enums\FontWeight;
    use Filament\Support\RawJs;

    $color = $getColor();
    $content = $getContent();
    $icon = $getIcon();
    $iconPosition = $getIconPosition();
    $iconSize = $getIconSize();
    $size = $getSize();
    $tooltip = $getTooltip();
    $weight = $getWeight();
    $fontFamily = $getFontFamily();

    $copyableState = $getCopyableState($content) ?? $content;
    $copyMessage = $getCopyMessage($copyableState);
    $copyMessageDuration = $getCopyMessageDuration($copyableState);
    $isCopyable = $isCopyable($copyableState);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isBadge()): ?>
    <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $color,'icon' => $icon,'iconPosition' => $iconPosition,'iconSize' => $iconSize,'size' => $size instanceof \Filament\Support\Enums\TextSize ? $size->value : $size,'xOn:click' => 
            $isCopyable ? '
                window.navigator.clipboard.writeText(' . \Illuminate\Support\Js::from($copyableState) . ')
                $tooltip(' . \Illuminate\Support\Js::from($copyMessage) . ', {
                    theme: $store.theme,
                    timeout: ' . \Illuminate\Support\Js::from($copyMessageDuration) . ',
                })
            ' : null
        ,'tag' => $isCopyable ? 'button' : 'span','tooltip' => $tooltip,'attributes' => \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag()->class(['fi-sc-text']))]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($size instanceof \Filament\Support\Enums\TextSize ? $size->value : $size),'x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            $isCopyable ? '
                window.navigator.clipboard.writeText(' . \Illuminate\Support\Js::from($copyableState) . ')
                $tooltip(' . \Illuminate\Support\Js::from($copyMessage) . ', {
                    theme: $store.theme,
                    timeout: ' . \Illuminate\Support\Js::from($copyMessageDuration) . ',
                })
            ' : null
        ),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isCopyable ? 'button' : 'span'),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($getExtraAttributeBag()->class(['fi-sc-text'])))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php echo e($content); ?>

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
<?php else: ?>
    <span
        <?php if($isCopyable): ?>
            x-on:click="
                window.navigator.clipboard.writeText(<?php echo \Illuminate\Support\Js::from($copyableState)->toHtml() ?>)
                $tooltip(<?php echo \Illuminate\Support\Js::from($copyMessage)->toHtml() ?>, {
                    theme: $store.theme,
                    timeout: <?php echo \Illuminate\Support\Js::from($copyMessageDuration)->toHtml() ?>,
                })
            "
        <?php endif; ?>
        <?php if(filled($tooltip)): ?>
            x-tooltip="{
                content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
                theme: $store.theme,
                allowHTML: <?php echo \Illuminate\Support\Js::from($tooltip instanceof \Illuminate\Contracts\Support\Htmlable)->toHtml() ?>,
            }"
        <?php endif; ?>
        <?php echo e((new \Illuminate\View\ComponentAttributeBag)
                ->color(TextComponent::class, $color)
                ->class([
                    'fi-sc-text',
                    'fi-copyable' => $isCopyable,
                    ($size instanceof \BackedEnum) ? "fi-size-{$size->value}" : $size,
                    ($weight instanceof FontWeight) ? "fi-font-{$weight->value}" : $weight,
                    ($fontFamily instanceof FontFamily) ? "fi-font-{$fontFamily->value}" : $fontFamily,
                ])
                ->merge($getExtraAttributes(), escape: false)); ?>

    >
        <?php echo e($content); ?>

    </span>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/text.blade.php ENDPATH**/ ?>