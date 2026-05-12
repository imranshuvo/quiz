<div>
    <?php
        $navigation = filament()->getNavigation();
        $isRtl = __('filament-panels::layout.direction') === 'rtl';
        $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
        $isSidebarFullyCollapsibleOnDesktop = filament()->isSidebarFullyCollapsibleOnDesktop();
        $hasNavigation = filament()->hasNavigation();
        $hasTopbar = filament()->hasTopbar();
    ?>

    
    <aside
        x-data="{}"
        <?php if($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop): ?>
            x-cloak
        <?php else: ?>
            x-cloak="-lg"
        <?php endif; ?>
        x-bind:class="{ 'fi-sidebar-open': $store.sidebar.isOpen }"
        class="fi-sidebar fi-main-sidebar"
    >
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_START)); ?>


        <div class="fi-sidebar-header-ctn">
            <header
                class="fi-sidebar-header"
            >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((! $hasTopbar) && $isSidebarCollapsibleOnDesktop): ?>
                    <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => $isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronLeft : \Filament\Support\Icons\Heroicon::OutlinedChevronRight,'iconAlias' => 
                            $isRtl
                            ? [
                                \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL,
                                \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON,
                            ]
                            : \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON
                        ,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.expand.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.open()','xShow' => '! $store.sidebar.isOpen','class' => 'fi-sidebar-open-collapse-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronLeft : \Filament\Support\Icons\Heroicon::OutlinedChevronRight),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                            $isRtl
                            ? [
                                \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL,
                                \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON,
                            ]
                            : \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON
                        ),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.expand.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.open()','x-show' => '! $store.sidebar.isOpen','class' => 'fi-sidebar-open-collapse-sidebar-btn']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $attributes = $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $component = $__componentOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((! $hasTopbar) && ($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop)): ?>
                    <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => $isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronRight : \Filament\Support\Icons\Heroicon::OutlinedChevronLeft,'iconAlias' => 
                            $isRtl
                            ? [
                                \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL,
                                \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON,
                            ]
                            : \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON
                        ,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.collapse.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.close()','xShow' => '$store.sidebar.isOpen','class' => 'fi-sidebar-close-collapse-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronRight : \Filament\Support\Icons\Heroicon::OutlinedChevronLeft),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                            $isRtl
                            ? [
                                \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL,
                                \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON,
                            ]
                            : \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON
                        ),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.collapse.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.close()','x-show' => '$store.sidebar.isOpen','class' => 'fi-sidebar-close-collapse-sidebar-btn']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $attributes = $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $component = $__componentOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_LOGO_BEFORE)); ?>


                <div
                    <?php if($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop): ?>
                        x-show="$store.sidebar.isOpen"
                    <?php endif; ?>
                    class="fi-sidebar-header-logo-ctn"
                >
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($homeUrl = filament()->getHomeUrl()): ?>
                        <a <?php echo e(\Filament\Support\generate_href_html($homeUrl)); ?>>
                            <?php if (isset($component)) { $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $attributes = $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $component = $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
                        </a>
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $attributes = $__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__attributesOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94)): ?>
<?php $component = $__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94; ?>
<?php unset($__componentOriginalb501e8c73315a10eb0eb5fd14fda0d94); ?>
<?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_LOGO_AFTER)); ?>

            </header>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->hasTenancy() && filament()->hasTenantMenu()): ?>
            <?php if (isset($component)) { $__componentOriginal32b9f4abfc80490155cb7c5dfaf8790d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32b9f4abfc80490155cb7c5dfaf8790d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.tenant-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::tenant-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal32b9f4abfc80490155cb7c5dfaf8790d)): ?>
<?php $attributes = $__attributesOriginal32b9f4abfc80490155cb7c5dfaf8790d; ?>
<?php unset($__attributesOriginal32b9f4abfc80490155cb7c5dfaf8790d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal32b9f4abfc80490155cb7c5dfaf8790d)): ?>
<?php $component = $__componentOriginal32b9f4abfc80490155cb7c5dfaf8790d; ?>
<?php unset($__componentOriginal32b9f4abfc80490155cb7c5dfaf8790d); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->isGlobalSearchEnabled() && filament()->getGlobalSearchPosition() === \Filament\Enums\GlobalSearchPosition::Sidebar): ?>
            <div
                <?php if($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop): ?>
                    x-show="$store.sidebar.isOpen"
                <?php endif; ?>
            >
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(Filament\Livewire\GlobalSearch::class);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1843662068-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <nav class="fi-sidebar-nav">
            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_START)); ?>


            <ul class="fi-sidebar-nav-groups">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $isGroupActive = $group->isActive();
                        $isGroupCollapsible = $group->isCollapsible();
                        $groupIcon = $group->getIcon();
                        $groupItems = $group->getItems();
                        $groupLabel = $group->getLabel();
                        $groupExtraSidebarAttributeBag = $group->getExtraSidebarAttributeBag();
                    ?>

                    <?php if (isset($component)) { $__componentOriginal59b772cc9788bdb14bf9872624b4f33a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59b772cc9788bdb14bf9872624b4f33a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.sidebar.group','data' => ['active' => $isGroupActive,'collapsible' => $isGroupCollapsible,'icon' => $groupIcon,'items' => $groupItems,'label' => $groupLabel,'attributes' => \Filament\Support\prepare_inherited_attributes($groupExtraSidebarAttributeBag)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::sidebar.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupActive),'collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupCollapsible),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupIcon),'items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupItems),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupLabel),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($groupExtraSidebarAttributeBag))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal59b772cc9788bdb14bf9872624b4f33a)): ?>
<?php $attributes = $__attributesOriginal59b772cc9788bdb14bf9872624b4f33a; ?>
<?php unset($__attributesOriginal59b772cc9788bdb14bf9872624b4f33a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal59b772cc9788bdb14bf9872624b4f33a)): ?>
<?php $component = $__componentOriginal59b772cc9788bdb14bf9872624b4f33a; ?>
<?php unset($__componentOriginal59b772cc9788bdb14bf9872624b4f33a); ?>
<?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ul>

            <script>
                var collapsedGroups = JSON.parse(
                    localStorage.getItem('collapsedGroups'),
                )

                if (collapsedGroups === null || collapsedGroups === 'null') {
                    localStorage.setItem(
                        'collapsedGroups',
                        JSON.stringify(<?php echo \Illuminate\Support\Js::from(
                        collect($navigation)
                            ->filter(fn (\Filament\Navigation\NavigationGroup $group): bool => $group->isCollapsed())
                            ->map(fn (\Filament\Navigation\NavigationGroup $group): string => $group->getLabel())
                            ->values()
                            ->all()
                    )->toHtml() ?>),
                    )
                }

                collapsedGroups = JSON.parse(
                    localStorage.getItem('collapsedGroups'),
                )

                document
                    .querySelectorAll('.fi-sidebar-group')
                    .forEach((group) => {
                        if (
                            !collapsedGroups.includes(group.dataset.groupLabel)
                        ) {
                            return
                        }

                        // Alpine.js loads too slow, so attempt to hide a
                        // collapsed sidebar group earlier.
                        group.querySelector(
                            '.fi-sidebar-group-items',
                        ).style.display = 'none'
                        group.classList.add('fi-collapsed')
                    })
            </script>

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_END)); ?>

        </nav>

        <?php
            $isAuthenticated = filament()->auth()->check();
            $hasDatabaseNotificationsInSidebar = filament()->hasDatabaseNotifications() && filament()->getDatabaseNotificationsPosition() === \Filament\Enums\DatabaseNotificationsPosition::Sidebar;
            $hasUserMenuInSidebar = filament()->hasUserMenu() && filament()->getUserMenuPosition() === \Filament\Enums\UserMenuPosition::Sidebar;
            $shouldRenderFooter = $isAuthenticated && ($hasDatabaseNotificationsInSidebar || $hasUserMenuInSidebar);
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($shouldRenderFooter): ?>
            <div class="fi-sidebar-footer">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDatabaseNotificationsInSidebar): ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(filament()->getDatabaseNotificationsLivewireComponent(), [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                    ]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1843662068-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasUserMenuInSidebar): ?>
                    <?php if (isset($component)) { $__componentOriginalf72c4437b846e6919081d8fc29939c50 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf72c4437b846e6919081d8fc29939c50 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf72c4437b846e6919081d8fc29939c50)): ?>
<?php $attributes = $__attributesOriginalf72c4437b846e6919081d8fc29939c50; ?>
<?php unset($__attributesOriginalf72c4437b846e6919081d8fc29939c50); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf72c4437b846e6919081d8fc29939c50)): ?>
<?php $component = $__componentOriginalf72c4437b846e6919081d8fc29939c50; ?>
<?php unset($__componentOriginalf72c4437b846e6919081d8fc29939c50); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_FOOTER)); ?>

    </aside>
    

    <?php if (isset($component)) { $__componentOriginal028e05680f6c5b1e293abd7fbe5f9758 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.modals','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-actions::modals'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758)): ?>
<?php $attributes = $__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758; ?>
<?php unset($__attributesOriginal028e05680f6c5b1e293abd7fbe5f9758); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal028e05680f6c5b1e293abd7fbe5f9758)): ?>
<?php $component = $__componentOriginal028e05680f6c5b1e293abd7fbe5f9758; ?>
<?php unset($__componentOriginal028e05680f6c5b1e293abd7fbe5f9758); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/livewire/sidebar.blade.php ENDPATH**/ ?>