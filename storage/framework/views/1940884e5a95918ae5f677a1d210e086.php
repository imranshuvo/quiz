<div class="fi-topbar-ctn">
    <?php
        $isRtl = __('filament-panels::layout.direction') === 'rtl';
        $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
        $isSidebarFullyCollapsibleOnDesktop = filament()->isSidebarFullyCollapsibleOnDesktop();
        $hasTopNavigation = filament()->hasTopNavigation();
        $hasNavigation = filament()->hasNavigation();
        $hasTenancy = filament()->hasTenancy();
    ?>

    <nav class="fi-topbar">
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_START)); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasNavigation): ?>
            <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => \Filament\Support\Icons\Heroicon::OutlinedBars3,'iconAlias' => \Filament\View\PanelsIconAlias::TOPBAR_OPEN_SIDEBAR_BUTTON,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.expand.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.open()','xShow' => '! $store.sidebar.isOpen','class' => 'fi-topbar-open-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::OutlinedBars3),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\View\PanelsIconAlias::TOPBAR_OPEN_SIDEBAR_BUTTON),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.expand.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.open()','x-show' => '! $store.sidebar.isOpen','class' => 'fi-topbar-open-sidebar-btn']); ?>
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

            <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => \Filament\Support\Icons\Heroicon::OutlinedXMark,'iconAlias' => \Filament\View\PanelsIconAlias::TOPBAR_CLOSE_SIDEBAR_BUTTON,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.collapse.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.close()','xShow' => '$store.sidebar.isOpen','class' => 'fi-topbar-close-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::OutlinedXMark),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\View\PanelsIconAlias::TOPBAR_CLOSE_SIDEBAR_BUTTON),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.collapse.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.close()','x-show' => '$store.sidebar.isOpen','class' => 'fi-topbar-close-sidebar-btn']); ?>
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

        <div class="fi-topbar-start">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop): ?>
                <div
                    x-show="$store.sidebar.isOpen || <?php echo \Illuminate\Support\Js::from($isSidebarCollapsibleOnDesktop)->toHtml() ?>"
                    class="fi-topbar-collapse-sidebar-btn-ctn"
                >
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSidebarCollapsibleOnDesktop): ?>
                        <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => $isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronLeft : \Filament\Support\Icons\Heroicon::OutlinedChevronRight,'iconAlias' => 
                                $isRtl
                                ? [
                                    \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL,
                                    \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON,
                                ]
                                : \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON
                            ,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.expand.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.open()','xShow' => '! $store.sidebar.isOpen','class' => 'fi-topbar-open-collapse-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            ),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.expand.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.open()','x-show' => '! $store.sidebar.isOpen','class' => 'fi-topbar-open-collapse-sidebar-btn']); ?>
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

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop): ?>
                        <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => $isRtl ? \Filament\Support\Icons\Heroicon::OutlinedChevronRight : \Filament\Support\Icons\Heroicon::OutlinedChevronLeft,'iconAlias' => 
                                $isRtl
                                ? [
                                    \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL,
                                    \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON,
                                ]
                                : \Filament\View\PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON
                            ,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.collapse.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.close()','xShow' => '$store.sidebar.isOpen','class' => 'fi-topbar-close-collapse-sidebar-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            ),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.collapse.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.close()','x-show' => '$store.sidebar.isOpen','class' => 'fi-topbar-close-collapse-sidebar-btn']); ?>
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
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_LOGO_BEFORE)); ?>


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

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_LOGO_AFTER)); ?>

        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasTopNavigation || (! $hasNavigation)): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasTenancy && filament()->hasTenantMenu()): ?>
                <?php if (isset($component)) { $__componentOriginal32b9f4abfc80490155cb7c5dfaf8790d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32b9f4abfc80490155cb7c5dfaf8790d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.tenant-menu','data' => ['teleport' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::tenant-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['teleport' => true]); ?>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasNavigation): ?>
                <?php
                    $navigation = filament()->getNavigation();
                ?>

                <ul class="fi-topbar-nav-groups">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $groupLabel = $group->getLabel();
                            $groupExtraTopbarAttributeBag = $group->getExtraTopbarAttributeBag();
                            $isGroupActive = $group->isActive();
                            $groupIcon = $group->getIcon();
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($groupLabel): ?>
                            <?php if (isset($component)) { $__componentOriginal22ab0dbc2c6619d5954111bba06f01db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['placement' => 'bottom-start','teleport' => true,'attributes' => \Filament\Support\prepare_inherited_attributes($groupExtraTopbarAttributeBag)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placement' => 'bottom-start','teleport' => true,'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($groupExtraTopbarAttributeBag))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                 <?php $__env->slot('trigger', null, []); ?> 
                                    <?php if (isset($component)) { $__componentOriginal42035aa49c877d648231e14ff76681c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42035aa49c877d648231e14ff76681c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.topbar.item','data' => ['active' => $isGroupActive,'icon' => $groupIcon]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupActive),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupIcon)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                        <?php echo e($groupLabel); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $attributes = $__attributesOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__attributesOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $component = $__componentOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__componentOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
                                 <?php $__env->endSlot(); ?>

                                <?php
                                    $lists = [];

                                    foreach ($group->getItems() as $item) {
                                        if ($childItems = $item->getChildItems()) {
                                            $lists[] = [
                                                $item,
                                                ...$childItems,
                                            ];
                                            $lists[] = [];

                                            continue;
                                        }

                                        if (empty($lists)) {
                                            $lists[] = [$item];

                                            continue;
                                        }

                                        $lists[count($lists) - 1][] = $item;
                                    }

                                    if (empty($lists[count($lists) - 1])) {
                                        array_pop($lists);
                                    }
                                ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
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

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <?php
                                                $isItemActive = $item->isActive();
                                                $itemBadge = $item->getBadge();
                                                $itemBadgeColor = $item->getBadgeColor($itemBadge);
                                                $itemBadgeTooltip = $item->getBadgeTooltip($itemBadge);
                                                $itemUrl = $item->getUrl();
                                                $itemIcon = $isItemActive ? ($item->getActiveIcon() ?? $item->getIcon()) : $item->getIcon();
                                                $shouldItemOpenUrlInNewTab = $item->shouldOpenUrlInNewTab();
                                                $itemExtraAttributes = $item->getExtraAttributeBag();
                                            ?>

                                            <?php if (isset($component)) { $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['badge' => $itemBadge,'badgeColor' => $itemBadgeColor,'badgeTooltip' => $itemBadgeTooltip,'color' => $isItemActive ? 'primary' : 'gray','href' => $itemUrl,'icon' => $itemIcon,'tag' => 'a','target' => $shouldItemOpenUrlInNewTab ? '_blank' : null,'attributes' => \Filament\Support\prepare_inherited_attributes($itemExtraAttributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadgeColor),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadgeTooltip),'color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isItemActive ? 'primary' : 'gray'),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemUrl),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemIcon),'tag' => 'a','target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shouldItemOpenUrlInNewTab ? '_blank' : null),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($itemExtraAttributes))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                                <?php echo e($item->getLabel()); ?>

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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                        <?php else: ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $group->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php
                                    $isItemActive = $item->isActive();
                                    $itemActiveIcon = $item->getActiveIcon();
                                    $itemBadge = $item->getBadge();
                                    $itemBadgeColor = $item->getBadgeColor($itemBadge);
                                    $itemBadgeTooltip = $item->getBadgeTooltip($itemBadge);
                                    $itemIcon = $item->getIcon();
                                    $shouldItemOpenUrlInNewTab = $item->shouldOpenUrlInNewTab();
                                    $itemUrl = $item->getUrl();
                                    $itemExtraAttributes = $item->getExtraAttributeBag();
                                ?>

                                <?php if (isset($component)) { $__componentOriginal42035aa49c877d648231e14ff76681c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42035aa49c877d648231e14ff76681c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.topbar.item','data' => ['active' => $isItemActive,'activeIcon' => $itemActiveIcon,'badge' => $itemBadge,'badgeColor' => $itemBadgeColor,'badgeTooltip' => $itemBadgeTooltip,'icon' => $itemIcon,'shouldOpenUrlInNewTab' => $shouldItemOpenUrlInNewTab,'url' => $itemUrl,'attributes' => \Filament\Support\prepare_inherited_attributes($itemExtraAttributes)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::topbar.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isItemActive),'active-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemActiveIcon),'badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadge),'badge-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadgeColor),'badge-tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemBadgeTooltip),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemIcon),'should-open-url-in-new-tab' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shouldItemOpenUrlInNewTab),'url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($itemUrl),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($itemExtraAttributes))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                    <?php echo e($item->getLabel()); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $attributes = $__attributesOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__attributesOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42035aa49c877d648231e14ff76681c7)): ?>
<?php $component = $__componentOriginal42035aa49c877d648231e14ff76681c7; ?>
<?php unset($__componentOriginal42035aa49c877d648231e14ff76681c7); ?>
<?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div
            <?php if($hasTenancy): ?>
                x-persist="topbar.end.panel-<?php echo e(filament()->getId()); ?>.tenant-<?php echo e(filament()->getTenant()?->getKey()); ?>"
            <?php else: ?>
                x-persist="topbar.end.panel-<?php echo e(filament()->getId()); ?>"
            <?php endif; ?>
            class="fi-topbar-end"
        >
            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_BEFORE)); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->isGlobalSearchEnabled() && filament()->getGlobalSearchPosition() === \Filament\Enums\GlobalSearchPosition::Topbar): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(Filament\Livewire\GlobalSearch::class);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2455242620-0', $__key);

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

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_AFTER)); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->auth()->check()): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->hasDatabaseNotifications() && filament()->getDatabaseNotificationsPosition() === \Filament\Enums\DatabaseNotificationsPosition::Topbar): ?>
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

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2455242620-1', $__key);

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

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->hasUserMenu() && filament()->getUserMenuPosition() === \Filament\Enums\UserMenuPosition::Topbar): ?>
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_END)); ?>

    </nav>

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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/livewire/topbar.blade.php ENDPATH**/ ?>