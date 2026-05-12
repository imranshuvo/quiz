<?php
    use Filament\Support\Enums\IconPosition;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'active' => false,
    'alpineActive' => null,
    'alpineDeferredBadgeData' => null,
    'alpineDeferredBadgeLoading' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'badgeIcon' => null,
    'badgeIconPosition' => IconPosition::Before,
    'href' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconPosition' => IconPosition::Before,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
    'type' => 'button',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'active' => false,
    'alpineActive' => null,
    'alpineDeferredBadgeData' => null,
    'alpineDeferredBadgeLoading' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'badgeIcon' => null,
    'badgeIconPosition' => IconPosition::Before,
    'href' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconPosition' => IconPosition::Before,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    if (! $iconPosition instanceof IconPosition) {
        $iconPosition = filled($iconPosition) ? (IconPosition::tryFrom($iconPosition) ?? $iconPosition) : null;
    }

    $hasAlpineActiveClasses = filled($alpineActive);
    $hasDeferredBadge = filled($alpineDeferredBadgeData);
?>

<<?php echo e($tag); ?>

    <?php if($tag === 'button'): ?>
        type="<?php echo e($type); ?>"
    <?php elseif($tag === 'a'): ?>
        <?php echo e(\Filament\Support\generate_href_html($href, $target === '_blank', $spaMode)); ?>

    <?php endif; ?>
    <?php if($hasAlpineActiveClasses): ?>
        x-bind:class="{
            'fi-active': <?php echo e($alpineActive); ?>,
        }"
    <?php endif; ?>
    <?php echo e($attributes
            ->merge([
                'aria-selected' => $active,
                'role' => 'tab',
            ])
            ->class([
                'fi-tabs-item',
                'fi-active' => (! $hasAlpineActiveClasses) && $active,
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon && $iconPosition === IconPosition::Before): ?>
        <?php echo e(\Filament\Support\generate_icon_html($icon)); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <span class="fi-tabs-item-label">
        <?php echo e($slot); ?>

    </span>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon && $iconPosition === IconPosition::After): ?>
        <?php echo e(\Filament\Support\generate_icon_html($icon)); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($badge)): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($badge instanceof \Illuminate\View\ComponentSlot): ?>
            <?php echo e($badge); ?>

        <?php else: ?>
            <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => ['color' => $badgeColor,'icon' => $badgeIcon,'iconPosition' => $badgeIconPosition,'size' => 'sm','tooltip' => $badgeTooltip]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeColor),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeIcon),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeIconPosition),'size' => 'sm','tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badgeTooltip)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php echo e($badge); ?>

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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php elseif($hasDeferredBadge): ?>
        <span
            x-show="<?php echo e($alpineDeferredBadgeLoading); ?>"
            x-cloak
            class="fi-tabs-item-badge-placeholder"
        >
            <?php echo e(\Filament\Support\generate_loading_indicator_html(size: \Filament\Support\Enums\IconSize::Small)); ?>

        </span>

        <template
            x-if="
                ! <?php echo e($alpineDeferredBadgeLoading); ?> &&
                    <?php echo e($alpineDeferredBadgeData); ?>?.badge != null
            "
        >
            <span
                x-bind:class="
                    'fi-badge fi-size-sm ' +
                        (<?php echo e($alpineDeferredBadgeData); ?>?.badgeColorClasses ?? '')
                "
                x-bind:style="<?php echo e($alpineDeferredBadgeData); ?>?.badgeColorStyles ?? ''"
                x-init="
                    let tooltip = <?php echo e($alpineDeferredBadgeData); ?>?.badgeTooltip
                    if (tooltip) {
                        window.tippy?.($el, {
                            content: tooltip,
                            theme: $store.theme,
                        })
                    }
                "
            >
                <template
                    x-if="
                        <?php echo e($alpineDeferredBadgeData); ?>?.badgeIconHtml &&
                            <?php echo e($alpineDeferredBadgeData); ?>?.badgeIconPosition !== 'after'
                    "
                >
                    <span
                        x-html="<?php echo e($alpineDeferredBadgeData); ?>.badgeIconHtml"
                    ></span>
                </template>

                <span class="fi-badge-label-ctn">
                    <span
                        class="fi-badge-label"
                        x-text="<?php echo e($alpineDeferredBadgeData); ?>?.badge"
                    ></span>
                </span>

                <template
                    x-if="
                        <?php echo e($alpineDeferredBadgeData); ?>?.badgeIconHtml &&
                            <?php echo e($alpineDeferredBadgeData); ?>?.badgeIconPosition === 'after'
                    "
                >
                    <span
                        x-html="<?php echo e($alpineDeferredBadgeData); ?>.badgeIconHtml"
                    ></span>
                </template>
            </span>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?php echo e($tag); ?>>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/tabs/item.blade.php ENDPATH**/ ?>