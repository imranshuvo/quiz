<?php
    use Filament\Schemas\Components\Tabs\Tab;
    use Filament\Schemas\View\SchemaIconAlias;
    use Filament\Support\Icons\Heroicon;

    $activeTab = $getActiveTab();
    $hasDeferredBadges = $hasDeferredBadges();
    $id = $getId();
    $isContained = $isContained();
    $isScrollable = $isScrollable();
    $isVertical = $isVertical();
    $label = $getLabel();
    $livewireProperty = $getLivewireProperty();
    $renderHookScopes = $getRenderHookScopes();
    $tabs = $getChildSchema()->getComponents();
    $tabsKey = $getKey();

    $getTabVisibilityJs = function (Tab $tab, ?int $index = null, ?string $mode = null) use ($isScrollable): ?string {
        $hiddenJs = $tab->getHiddenJs();
        $visibleJs = $tab->getVisibleJs();

        $baseJs = match ([filled($hiddenJs), filled($visibleJs)]) {
            [true, true] => "(! ({$hiddenJs})) && ({$visibleJs})",
            [true, false] => "! ({$hiddenJs})",
            [false, true] => $visibleJs,
            default => null,
        };

        if ($isScrollable || $index === null || $mode === null) {
            return $baseJs;
        }

        $tabKey = $tab->getKey(isAbsolute: false);

        $dropdownJs = match ($mode) {
            'inline' => "(!withinDropdownMounted || withinDropdownIndex === null || {$index} < withinDropdownIndex)",
            'trigger' => "(withinDropdownMounted && withinDropdownIndex !== null && {$index} >= withinDropdownIndex && '{$tabKey}' === tab)",
            default => null,
        };

        return $baseJs ? "{$baseJs} && {$dropdownJs}" : $dropdownJs;
    };
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(blank($livewireProperty)): ?>
    <div
        x-data="tabsSchemaComponent({
            activeTab: <?php echo \Illuminate\Support\Js::from($activeTab)->toHtml() ?>,
            isScrollable: <?php echo \Illuminate\Support\Js::from($isScrollable)->toHtml() ?>,
            isTabPersisted: <?php echo \Illuminate\Support\Js::from($isTabPersisted())->toHtml() ?>,
            isTabPersistedInQueryString: <?php echo \Illuminate\Support\Js::from($isTabPersistedInQueryString())->toHtml() ?>,
            livewireId: <?php echo \Illuminate\Support\Js::from($this->getId())->toHtml() ?>,
            schemaKey: <?php echo \Illuminate\Support\Js::from($getRootContainer()->getKey())->toHtml() ?>,
            tab: <?php if($isTabPersisted() && filled($id)): ?> $persist(null).as(<?php echo \Illuminate\Support\Js::from($id)->toHtml() ?>) <?php else: ?> <?php echo \Illuminate\Support\Js::from(null)->toHtml() ?> <?php endif; ?>,
            tabQueryStringKey: <?php echo \Illuminate\Support\Js::from($getTabQueryStringKey())->toHtml() ?>,
        })"
        x-load
        x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('tabs', 'filament/schemas')); ?>"
        wire:ignore.self
        <?php echo e($attributes
                ->merge([
                    'id' => $id,
                    'wire:key' => $getLivewireKey() . '.container',
                ], escape: false)
                ->merge($getExtraAttributes(), escape: false)
                ->merge($getExtraAlpineAttributes(), escape: false)
                ->class([
                    'fi-sc-tabs',
                    'fi-contained' => $isContained,
                    'fi-vertical' => $isVertical,
                ])); ?>

    >
        <input
            type="hidden"
            value="<?php echo e(collect($tabs)->filter(static fn (Tab $tab): bool => $tab->isVisible())->map(static fn (Tab $tab) => $tab->getKey(isAbsolute: false))->values()->toJson()); ?>"
            x-ref="tabsData"
        />

        <?php if (isset($component)) { $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.index','data' => ['contained' => $isContained,'label' => $label,'vertical' => $isVertical,'xCloak' => true,'xBind:class' => ! $isScrollable ? '{ \'fi-invisible\': ! withinDropdownMounted }' : null,'xData' => 
                $hasDeferredBadges ? '{
                    deferredBadges: {},
                    isLoadingDeferredBadges: true,

                    async init() {
                        try {
                            const badges = await $wire.callSchemaComponentMethod(' . \Illuminate\Support\Js::from($tabsKey) . ', \'getDeferredTabBadges\')
                            this.deferredBadges = badges ?? {}
                        } finally {
                            this.isLoadingDeferredBadges = false
                        }
                    },
                }' : null
            ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['contained' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isContained),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'vertical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isVertical),'x-cloak' => true,'x-bind:class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $isScrollable ? '{ \'fi-invisible\': ! withinDropdownMounted }' : null),'x-data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                $hasDeferredBadges ? '{
                    deferredBadges: {},
                    isLoadingDeferredBadges: true,

                    async init() {
                        try {
                            const badges = await $wire.callSchemaComponentMethod(' . \Illuminate\Support\Js::from($tabsKey) . ', \'getDeferredTabBadges\')
                            this.deferredBadges = badges ?? {}
                        } finally {
                            this.isLoadingDeferredBadges = false
                        }
                    },
                }' : null
            )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getStartRenderHooks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $startRenderHook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook($startRenderHook, scopes: $renderHookScopes)); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $isTabBadgeDeferred = $tab->isBadgeDeferred();
                    $tabBadge = $isTabBadgeDeferred ? null : $tab->getBadge();
                    $tabBadgeColor = $isTabBadgeDeferred ? null : $tab->getBadgeColor($tabBadge);
                    $tabBadgeIcon = $isTabBadgeDeferred ? null : $tab->getBadgeIcon($tabBadge);
                    $tabBadgeIconPosition = $isTabBadgeDeferred ? null : $tab->getBadgeIconPosition($tabBadge);
                    $tabBadgeTooltip = $isTabBadgeDeferred ? null : $tab->getBadgeTooltip($tabBadge);
                    $tabExtraAttributeBag = $tab->getExtraAttributeBag();
                    $tabIcon = $tab->getIcon();
                    $tabIconPosition = $tab->getIconPosition();
                    $tabKey = $tab->getKey(isAbsolute: false);
                    $tabLabel = $tab->getLabel();
                    $tabVisibilityJs = $getTabVisibilityJs($tab, $index, 'inline');
                ?>

                <?php if (isset($component)) { $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['alpineActive' => 'tab === \'' . $tabKey . '\'','alpineDeferredBadgeData' => $isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null,'alpineDeferredBadgeLoading' => $isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null,'attributes' => $tabExtraAttributeBag,'badge' => $tabBadge,'badgeColor' => $tabBadgeColor,'badgeIcon' => $tabBadgeIcon,'badgeIconPosition' => $tabBadgeIconPosition,'badgeTooltip' => $tabBadgeTooltip,'dataTabKey' => $tabKey,'icon' => $tabIcon,'iconPosition' => $tabIconPosition,'xCloak' => $tabVisibilityJs !== null,'xOn:click' => 'tab = \'' . $tabKey . '\'','xShow' => $tabVisibilityJs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alpine-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('tab === \'' . $tabKey . '\''),'alpine-deferred-badge-data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null),'alpine-deferred-badge-loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabExtraAttributeBag),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeColor),'badge-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeIcon),'badge-icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeIconPosition),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeTooltip),'data-tab-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabKey),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabIcon),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabIconPosition),'x-cloak' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabVisibilityJs !== null),'x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('tab = \'' . $tabKey . '\''),'x-show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabVisibilityJs)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php echo e($tabLabel); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $attributes = $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $component = $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isScrollable): ?>
                <?php if (isset($component)) { $__componentOriginal22ab0dbc2c6619d5954111bba06f01db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['placement' => __('filament-panels::layout.direction') === 'ltr' ? 'bottom-start' : 'bottom-end']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placement' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.direction') === 'ltr' ? 'bottom-start' : 'bottom-end')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('trigger', null, []); ?> 
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $isTabBadgeDeferred = $tab->isBadgeDeferred();
                                $tabBadge = $isTabBadgeDeferred ? null : $tab->getBadge();
                                $tabBadgeColor = $isTabBadgeDeferred ? null : $tab->getBadgeColor($tabBadge);
                                $tabBadgeTooltip = $isTabBadgeDeferred ? null : $tab->getBadgeTooltip($tabBadge);
                                $tabExtraAttributeBag = $tab->getExtraAttributeBag();
                                $tabKey = $tab->getKey(isAbsolute: false);
                                $tabLabel = $tab->getLabel();
                                $tabVisibilityJs = $getTabVisibilityJs($tab, $index, 'trigger');
                            ?>

                            <?php if (isset($component)) { $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['alpineActive' => 'tab === \'' . $tabKey . '\'','alpineDeferredBadgeData' => $isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null,'alpineDeferredBadgeLoading' => $isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null,'attributes' => $tabExtraAttributeBag,'badge' => $tabBadge,'badgeColor' => $tabBadgeColor,'badgeTooltip' => $tabBadgeTooltip,'icon' => Heroicon::ChevronDown,'iconAlias' => SchemaIconAlias::COMPONENTS_TABS_DROPDOWN_TRIGGER_BUTTON,'xCloak' => $tabVisibilityJs !== null,'xShow' => $tabVisibilityJs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alpine-active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('tab === \'' . $tabKey . '\''),'alpine-deferred-badge-data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null),'alpine-deferred-badge-loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabExtraAttributeBag),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeColor),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeTooltip),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Heroicon::ChevronDown),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(SchemaIconAlias::COMPONENTS_TABS_DROPDOWN_TRIGGER_BUTTON),'x-cloak' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabVisibilityJs !== null),'x-show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabVisibilityJs)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                <?php echo e($tabLabel); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $attributes = $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $component = $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['xShow' => 'isDropdownButtonVisible']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'isDropdownButtonVisible']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            <?php echo e(\Filament\Support\generate_icon_html(
                                    Heroicon::EllipsisHorizontal,
                                    alias: SchemaIconAlias::COMPONENTS_TABS_MORE_TABS_BUTTON,
                                )); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $attributes = $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $component = $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
                     <?php $__env->endSlot(); ?>

                    <?php if (isset($component)) { $__componentOriginal66687bf0670b9e16f61e667468dc8983 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66687bf0670b9e16f61e667468dc8983 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $isTabBadgeDeferred = $tab->isBadgeDeferred();
                                $tabBadge = $isTabBadgeDeferred ? null : $tab->getBadge();
                                $tabBadgeColor = $isTabBadgeDeferred ? null : $tab->getBadgeColor($tabBadge);
                                $tabBadgeTooltip = $isTabBadgeDeferred ? null : $tab->getBadgeTooltip($tabBadge);
                                $tabIcon = $tab->getIcon();
                                $tabKey = $tab->getKey(isAbsolute: false);
                                $tabLabel = $tab->getLabel();
                            ?>

                            <?php if (isset($component)) { $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['alpineDeferredBadgeData' => $isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null,'alpineDeferredBadgeLoading' => $isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null,'badge' => $tabBadge,'badgeColor' => $tabBadgeColor,'badgeTooltip' => $tabBadgeTooltip,'icon' => $tabIcon,'xBind:class' => '{ \'fi-selected\': tab === \''.e($tabKey).'\' }','xOn:click' => 'tab = \'' . $tabKey . '\'; close($event);','xShow' => $index . ' >= withinDropdownIndex']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alpine-deferred-badge-data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($index) . ']' : null),'alpine-deferred-badge-loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeColor),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeTooltip),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabIcon),'x-bind:class' => '{ \'fi-selected\': tab === \''.e($tabKey).'\' }','x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('tab = \'' . $tabKey . '\'; close($event);'),'x-show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($index . ' >= withinDropdownIndex')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                <?php echo e($tabLabel); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $attributes = $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $component = $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $attributes = $__attributesOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__attributesOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $component = $__componentOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__componentOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $attributes = $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $component = $__componentOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getEndRenderHooks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $endRenderHook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook($endRenderHook, scopes: $renderHookScopes)); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $attributes = $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $component = $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $tabVisibilityJs = $getTabVisibilityJs($tab);
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tabVisibilityJs): ?>
                <div x-cloak x-show="<?php echo $tabVisibilityJs; ?>">
                    <?php echo e($tab); ?>

                </div>
            <?php else: ?>
                <?php echo e($tab); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
<?php else: ?>
    <?php
        $activeTab = strval($this->{$livewireProperty});
    ?>

    <div
        <?php if($hasDeferredBadges): ?>
            x-data="{
                deferredBadges: {},
                isLoadingDeferredBadges: true,

                async init() {
                    try {
                        const badges = await $wire.callSchemaComponentMethod(
                            <?php echo \Illuminate\Support\Js::from($tabsKey)->toHtml() ?>,
                            'getDeferredTabBadges',
                        )

                        this.deferredBadges = badges ?? {}
                    } finally {
                        this.isLoadingDeferredBadges = false
                    }
                },
            }"
        <?php endif; ?>
        <?php echo e($attributes
                ->merge([
                    'id' => $id,
                    'wire:key' => $getLivewireKey() . '.container',
                ], escape: false)
                ->merge($getExtraAttributes(), escape: false)
                ->class([
                    'fi-sc-tabs',
                    'fi-contained' => $isContained,
                    'fi-vertical' => $isVertical,
                ])); ?>

    >
        <?php if (isset($component)) { $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.index','data' => ['contained' => $isContained,'label' => $label,'vertical' => $isVertical]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['contained' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isContained),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'vertical' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isVertical)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getStartRenderHooks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $startRenderHook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook($startRenderHook, scopes: $renderHookScopes)); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getChildSchema()->getComponents(withOriginalKeys: true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $isTabBadgeDeferred = $tab->isBadgeDeferred();
                    $tabBadge = $isTabBadgeDeferred ? null : $tab->getBadge();
                    $tabBadgeColor = $isTabBadgeDeferred ? null : $tab->getBadgeColor($tabBadge);
                    $tabBadgeIcon = $isTabBadgeDeferred ? null : $tab->getBadgeIcon($tabBadge);
                    $tabBadgeIconPosition = $isTabBadgeDeferred ? null : $tab->getBadgeIconPosition($tabBadge);
                    $tabBadgeTooltip = $isTabBadgeDeferred ? null : $tab->getBadgeTooltip($tabBadge);
                    $tabExtraAttributeBag = $tab->getExtraAttributeBag();
                    $tabIcon = $tab->getIcon();
                    $tabIconPosition = $tab->getIconPosition();
                    $tabKey = strval($tabKey);
                    $tabLabel = $tab->getLabel() ?? $this->generateTabLabel($tabKey);
                ?>

                <?php if (isset($component)) { $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.tabs.item','data' => ['active' => $activeTab === $tabKey,'alpineDeferredBadgeData' => $isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($tabKey) . ']' : null,'alpineDeferredBadgeLoading' => $isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null,'attributes' => $tabExtraAttributeBag,'badge' => $tabBadge,'badgeColor' => $tabBadgeColor,'badgeIcon' => $tabBadgeIcon,'badgeIconPosition' => $tabBadgeIconPosition,'badgeTooltip' => $tabBadgeTooltip,'icon' => $tabIcon,'iconPosition' => $tabIconPosition,'wire:click' => '$set(\'' . $livewireProperty . '\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::tabs.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeTab === $tabKey),'alpine-deferred-badge-data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'deferredBadges[' . \Illuminate\Support\Js::from($tabKey) . ']' : null),'alpine-deferred-badge-loading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isTabBadgeDeferred ? 'isLoadingDeferredBadges' : null),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabExtraAttributeBag),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeColor),'badge-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeIcon),'badge-icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeIconPosition),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabBadgeTooltip),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabIcon),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tabIconPosition),'wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('$set(\'' . $livewireProperty . '\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php echo e($tabLabel); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $attributes = $__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__attributesOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f)): ?>
<?php $component = $__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f; ?>
<?php unset($__componentOriginal35d4caf141547fb7d125e4ebd3c1b66f); ?>
<?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getEndRenderHooks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $endRenderHook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook($endRenderHook, scopes: $renderHookScopes)); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $attributes = $__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__attributesOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d)): ?>
<?php $component = $__componentOriginal447636fe67a19f9c79619fb5a3c0c28d; ?>
<?php unset($__componentOriginal447636fe67a19f9c79619fb5a3c0c28d); ?>
<?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getChildSchema()->getComponents(withOriginalKeys: true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php echo e($tab->key($tabKey)); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/tabs.blade.php ENDPATH**/ ?>