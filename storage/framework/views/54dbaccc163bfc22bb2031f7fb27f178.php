<?php
    use Filament\Support\Enums\IconSize;
    use Filament\Support\Enums\Size;
    use Filament\Support\View\Components\BadgeComponent;
    use Filament\Support\View\Components\DropdownComponent\ItemComponent;
    use Filament\Support\View\Components\DropdownComponent\ItemComponent\IconComponent;
    use Illuminate\View\ComponentAttributeBag;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'alpineDeferredBadgeData' => null,
    'alpineDeferredBadgeLoading' => null,
    'badge' => null,
    'badgeColor' => 'primary',
    'badgeTooltip' => null,
    'color' => 'gray',
    'disabled' => false,
    'href' => null,
    'icon' => null,
    'iconAlias' => null,
    'iconColor' => null,
    'iconSize' => null,
    'image' => null,
    'keyBindings' => null,
    'loadingIndicator' => true,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
    'tooltip' => null,
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
    'alpineDeferredBadgeData' => null,
    'alpineDeferredBadgeLoading' => null,
    'badge' => null,
    'badgeColor' => 'primary',
    'badgeTooltip' => null,
    'color' => 'gray',
    'disabled' => false,
    'href' => null,
    'icon' => null,
    'iconAlias' => null,
    'iconColor' => null,
    'iconSize' => null,
    'image' => null,
    'keyBindings' => null,
    'loadingIndicator' => true,
    'spaMode' => null,
    'tag' => 'button',
    'target' => null,
    'tooltip' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    if (filled($iconSize) && (! $iconSize instanceof IconSize)) {
        $iconSize = IconSize::tryFrom($iconSize) ?? $iconSize;
    }

    $iconColor ??= $color;

    $wireTarget = $loadingIndicator ? $attributes->whereStartsWith(['wire:target', 'wire:click'])->filter(fn ($value): bool => filled($value))->first() : null;

    $hasLoadingIndicator = filled($wireTarget);

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget, ENT_QUOTES);
    }

    $hasDeferredBadge = filled($alpineDeferredBadgeData);
    $hasTooltip = filled($tooltip);
?>

<?php echo ($tag === 'form') ? ('<form ' . $attributes->only(['action', 'class', 'method', 'wire:submit'])->toHtml() . '>') : ''; ?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tag === 'form'): ?>
    <?php echo csrf_field(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<<?php echo e(($tag === 'form') ? 'button' : $tag); ?>

    <?php if(($tag === 'a') && (! ($disabled && $hasTooltip))): ?>
        <?php echo e(\Filament\Support\generate_href_html($href, $target === '_blank', $spaMode)); ?>

    <?php endif; ?>
    <?php if($keyBindings): ?>
        x-bind:id="$id('key-bindings')"
        x-mousetrap.global.<?php echo e(collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.')); ?>="document.getElementById($el.id)?.click()"
    <?php endif; ?>
    <?php if($hasTooltip): ?>
        x-tooltip="{
            content: <?php echo \Illuminate\Support\Js::from($tooltip)->toHtml() ?>,
            theme: $store.theme,
            allowHTML: <?php echo \Illuminate\Support\Js::from($tooltip instanceof \Illuminate\Contracts\Support\Htmlable)->toHtml() ?>,
        }"
    <?php endif; ?>
    <?php echo e($attributes
            ->when(
                $tag === 'form',
                fn (ComponentAttributeBag $attributes) => $attributes->except(['action', 'class', 'method', 'wire:submit']),
            )
            ->merge([
                'aria-disabled' => $disabled ? 'true' : null,
                'disabled' => $disabled && blank($tooltip),
                'type' => match ($tag) {
                    'button' => 'button',
                    'form' => 'submit',
                    default => null,
                },
                'wire:loading.attr' => $tag === 'button' ? 'disabled' : null,
                'wire:target' => ($hasLoadingIndicator && $loadingIndicatorTarget) ? $loadingIndicatorTarget : null,
            ], escape: false)
            ->when(
                $disabled && $hasTooltip,
                fn (ComponentAttributeBag $attributes) => $attributes->filter(
                    fn (mixed $value, string $key): bool => ! str($key)->startsWith(['href', 'x-on:', 'wire:click']),
                ),
            )
            ->class([
                'fi-dropdown-list-item',
                'fi-disabled' => $disabled,
            ])
            ->color(ItemComponent::class, $color)); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
        <?php echo e(\Filament\Support\generate_icon_html($icon, $iconAlias, (new ComponentAttributeBag([
                'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => $hasLoadingIndicator,
                'wire:target' => $hasLoadingIndicator ? $loadingIndicatorTarget : false,
            ]))->color(IconComponent::class, $iconColor), size: $iconSize)); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($image): ?>
        <div
            class="fi-dropdown-list-item-image"
            style="background-image: url('<?php echo e($image); ?>')"
            <?php if($hasLoadingIndicator): ?>
                wire:loading.remove.delay.<?php echo e(config('filament.livewire_loading_delay', 'default')); ?>

                wire:target="<?php echo e($loadingIndicatorTarget); ?>"
            <?php endif; ?>
        ></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasLoadingIndicator): ?>
        <?php echo e(\Filament\Support\generate_loading_indicator_html((new ComponentAttributeBag([
                'wire:loading.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                'wire:target' => $loadingIndicatorTarget,
            ]))->color(IconComponent::class, $iconColor), size: $iconSize)); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <span class="fi-dropdown-list-item-label">
        <?php echo e($slot); ?>

    </span>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($badge)): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($badge instanceof \Illuminate\View\ComponentSlot): ?>
            <?php echo e($badge); ?>

        <?php else: ?>
            <span
                <?php if($badgeTooltip): ?>
                    x-tooltip="{
                        content: <?php echo \Illuminate\Support\Js::from($badgeTooltip)->toHtml() ?>,
                        theme: $store.theme,
                        allowHTML: <?php echo \Illuminate\Support\Js::from($badgeTooltip instanceof \Illuminate\Contracts\Support\Htmlable)->toHtml() ?>,
                    }"
                <?php endif; ?>
                <?php echo e((new ComponentAttributeBag)->color(BadgeComponent::class, $badgeColor)->class(['fi-badge'])); ?>

            >
                <?php echo e($badge); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php elseif($hasDeferredBadge): ?>
        <span
            x-show="<?php echo e($alpineDeferredBadgeLoading); ?>"
            x-cloak
            class="fi-dropdown-list-item-badge-placeholder"
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
                x-bind:class="'fi-badge ' + (<?php echo e($alpineDeferredBadgeData); ?>?.badgeColorClasses ?? '')"
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
                <span class="fi-badge-label-ctn">
                    <span
                        class="fi-badge-label"
                        x-text="<?php echo e($alpineDeferredBadgeData); ?>?.badge"
                    ></span>
                </span>
            </span>
        </template>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?php echo e(($tag === 'form') ? 'button' : $tag); ?>>

<?php echo ($tag === 'form') ? '</form>' : ''; ?>

<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/dropdown/list/item.blade.php ENDPATH**/ ?>