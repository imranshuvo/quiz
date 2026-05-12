<?php
    use Filament\Support\Enums\VerticalAlignment;

    $actions = $getChildSchema()->getComponents();
    $alignment = $getAlignment();
    $isFullWidth = $isFullWidth();
    $isSticky = $isSticky();
    $verticalAlignment = $getVerticalAlignment();

    if (! $verticalAlignment instanceof VerticalAlignment) {
        $verticalAlignment = filled($verticalAlignment) ? (VerticalAlignment::tryFrom($verticalAlignment) ?? $verticalAlignment) : null;
    }
?>

<div
    <?php if($isSticky): ?>
        x-data="filamentActionsSchemaComponent()"
        x-intersect:enter.half="disableSticky"
        x-intersect:leave="enableSticky"
        x-bind:class="{ 'fi-sticky': isSticky }"
    <?php endif; ?>
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-sc-actions',
                ($verticalAlignment instanceof VerticalAlignment) ? "fi-vertical-align-{$verticalAlignment->value}" : $verticalAlignment,
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($label = $getLabel())): ?>
        <div class="fi-sc-actions-label-ctn">
            <?php echo e($getChildSchema($schemaComponent::BEFORE_LABEL_SCHEMA_KEY)); ?>


            <div class="fi-sc-actions-label">
                <?php echo e($label); ?>

            </div>

            <?php echo e($getChildSchema($schemaComponent::AFTER_LABEL_SCHEMA_KEY)); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($aboveContentContainer = $getChildSchema($schemaComponent::ABOVE_CONTENT_SCHEMA_KEY)?->toHtmlString()): ?>
        <?php echo e($aboveContentContainer); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal59d80b1aec4ae4c914a3e52dede19504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.actions','data' => ['actions' => $actions,'alignment' => $alignment,'fullWidth' => $isFullWidth,'xBind:style' => $isSticky ? 'isSticky ? `width: ${width}px;` : \'\'' : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($alignment),'full-width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isFullWidth),'x-bind:style' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSticky ? 'isSticky ? `width: ${width}px;` : \'\'' : null)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $attributes = $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__attributesOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504)): ?>
<?php $component = $__componentOriginal59d80b1aec4ae4c914a3e52dede19504; ?>
<?php unset($__componentOriginal59d80b1aec4ae4c914a3e52dede19504); ?>
<?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($belowContentContainer = $getChildSchema($schemaComponent::BELOW_CONTENT_SCHEMA_KEY)?->toHtmlString()): ?>
        <?php echo e($belowContentContainer); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/actions.blade.php ENDPATH**/ ?>