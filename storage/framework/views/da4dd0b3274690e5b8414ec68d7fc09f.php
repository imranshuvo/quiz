<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'fullHeight' => false,
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
    'fullHeight' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use Filament\Pages\Enums\SubNavigationPosition;

    $subNavigation = $this->getCachedSubNavigation();
    $subNavigationPosition = $this->getSubNavigationPosition();
    $widgetData = $this->getWidgetData();
?>

<div
    <?php echo e($attributes->class([
            'fi-page',
            'fi-height-full' => $fullHeight,
            'fi-page-has-sub-navigation' => $subNavigation,
            "fi-page-has-sub-navigation-{$subNavigationPosition->value}" => $subNavigation,
            ...$this->getPageClasses(),
        ])); ?>

>
    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_START, scopes: $this->getRenderHookScopes())); ?>


    <div class="fi-page-header-main-ctn">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subNavigation): ?>
            <div
                class="fi-page-main-sub-navigation-mobile-menu-render-hook-ctn"
            >
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_MOBILE_MENU_BEFORE, scopes: $this->getRenderHookScopes())); ?>

            </div>

            <?php if (isset($component)) { $__componentOriginalece338083788b9a170af7d25fa4f4976 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalece338083788b9a170af7d25fa4f4976 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.sub-navigation.mobile-menu','data' => ['navigation' => $subNavigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page.sub-navigation.mobile-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subNavigation)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalece338083788b9a170af7d25fa4f4976)): ?>
<?php $attributes = $__attributesOriginalece338083788b9a170af7d25fa4f4976; ?>
<?php unset($__attributesOriginalece338083788b9a170af7d25fa4f4976); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalece338083788b9a170af7d25fa4f4976)): ?>
<?php $component = $__componentOriginalece338083788b9a170af7d25fa4f4976; ?>
<?php unset($__componentOriginalece338083788b9a170af7d25fa4f4976); ?>
<?php endif; ?>

            <div
                class="fi-page-main-sub-navigation-mobile-menu-render-hook-ctn"
            >
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_MOBILE_MENU_AFTER, scopes: $this->getRenderHookScopes())); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($header = $this->getHeader()): ?>
            <?php echo e($header); ?>

        <?php else: ?>
            <?php
                $heading = $this->getHeading();
                $headerActions = $this->getCachedHeaderActions();
                $headerActionsAlignment = $this->getHeaderActionsAlignment();
                $breadcrumbs = filament()->hasBreadcrumbs() ? $this->getBreadcrumbs() : [];
                $subheading = $this->getSubheading();
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($headerActions) || $breadcrumbs || filled($heading) || filled($subheading)): ?>
                <?php if (isset($component)) { $__componentOriginal4af1e0a8ab5c0dda93279f6800da3911 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.header.index','data' => ['actions' => $headerActions,'actionsAlignment' => $headerActionsAlignment,'breadcrumbs' => $breadcrumbs,'heading' => $heading,'subheading' => $subheading]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headerActions),'actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headerActionsAlignment),'breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subheading)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($heading instanceof \Illuminate\Contracts\Support\Htmlable): ?>
                         <?php $__env->slot('heading', null, []); ?> 
                            <?php echo e($heading); ?>

                         <?php $__env->endSlot(); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subheading instanceof \Illuminate\Contracts\Support\Htmlable): ?>
                         <?php $__env->slot('subheading', null, []); ?> 
                            <?php echo e($subheading); ?>

                         <?php $__env->endSlot(); ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911)): ?>
<?php $attributes = $__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911; ?>
<?php unset($__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4af1e0a8ab5c0dda93279f6800da3911)): ?>
<?php $component = $__componentOriginal4af1e0a8ab5c0dda93279f6800da3911; ?>
<?php unset($__componentOriginal4af1e0a8ab5c0dda93279f6800da3911); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="fi-page-main">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subNavigation): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subNavigationPosition === SubNavigationPosition::Start): ?>
                    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_START_BEFORE, scopes: $this->getRenderHookScopes())); ?>


                    <?php if (isset($component)) { $__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.sub-navigation.sidebar','data' => ['navigation' => $subNavigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page.sub-navigation.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subNavigation)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3)): ?>
<?php $attributes = $__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3; ?>
<?php unset($__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3)): ?>
<?php $component = $__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3; ?>
<?php unset($__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3); ?>
<?php endif; ?>

                    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_START_AFTER, scopes: $this->getRenderHookScopes())); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subNavigationPosition === SubNavigationPosition::Top): ?>
                    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_TOP_BEFORE, scopes: $this->getRenderHookScopes())); ?>


                    <?php if (isset($component)) { $__componentOriginala59fd7cea3e42dfea7d868b466385a01 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala59fd7cea3e42dfea7d868b466385a01 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.sub-navigation.tabs','data' => ['navigation' => $subNavigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page.sub-navigation.tabs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subNavigation)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala59fd7cea3e42dfea7d868b466385a01)): ?>
<?php $attributes = $__attributesOriginala59fd7cea3e42dfea7d868b466385a01; ?>
<?php unset($__attributesOriginala59fd7cea3e42dfea7d868b466385a01); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala59fd7cea3e42dfea7d868b466385a01)): ?>
<?php $component = $__componentOriginala59fd7cea3e42dfea7d868b466385a01; ?>
<?php unset($__componentOriginala59fd7cea3e42dfea7d868b466385a01); ?>
<?php endif; ?>

                    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_TOP_AFTER, scopes: $this->getRenderHookScopes())); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="fi-page-content">
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_WIDGETS_BEFORE, scopes: $this->getRenderHookScopes())); ?>


                <?php echo e($this->headerWidgets); ?>


                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_WIDGETS_AFTER, scopes: $this->getRenderHookScopes())); ?>


                <?php echo e($slot); ?>


                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_FOOTER_WIDGETS_BEFORE, scopes: $this->getRenderHookScopes())); ?>


                <?php echo e($this->footerWidgets); ?>


                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_FOOTER_WIDGETS_AFTER, scopes: $this->getRenderHookScopes())); ?>

            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subNavigation && $subNavigationPosition === SubNavigationPosition::End): ?>
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_END_BEFORE, scopes: $this->getRenderHookScopes())); ?>


                <?php if (isset($component)) { $__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.sub-navigation.sidebar','data' => ['navigation' => $subNavigation]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page.sub-navigation.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['navigation' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subNavigation)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3)): ?>
<?php $attributes = $__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3; ?>
<?php unset($__attributesOriginal57dd3516f8d124ccafb2ae72c664c7c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3)): ?>
<?php $component = $__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3; ?>
<?php unset($__componentOriginal57dd3516f8d124ccafb2ae72c664c7c3); ?>
<?php endif; ?>

                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_END_AFTER, scopes: $this->getRenderHookScopes())); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($footer = $this->getFooter()): ?>
            <?php echo e($footer); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! ($this instanceof \Filament\Tables\Contracts\HasTable)): ?>
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
    <?php elseif($this->isTableLoaded() && filled($this->defaultTableAction)): ?>
        <div
            wire:init="mountAction(<?php echo \Illuminate\Support\Js::from($this->defaultTableAction)->toHtml() ?> , <?php if(filled($this->defaultTableActionArguments)): ?> <?php echo \Illuminate\Support\Js::from($this->defaultTableActionArguments)->toHtml() ?> <?php else: ?> {} <?php endif; ?> , <?php echo \Illuminate\Support\Js::from(['table' => true, 'recordKey' => $this->defaultTableActionRecord])->toHtml() ?>)"
        ></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($this->defaultAction)): ?>
        <div
            wire:init="mountAction(<?php echo \Illuminate\Support\Js::from($this->defaultAction)->toHtml() ?> <?php if(filled($this->defaultActionArguments) || filled($this->defaultActionContext)): ?> , <?php if(filled($this->defaultActionArguments)): ?> <?php echo \Illuminate\Support\Js::from($this->defaultActionArguments)->toHtml() ?> <?php else: ?> {} <?php endif; ?> <?php endif; ?> <?php if(filled($this->defaultActionContext)): ?> , <?php echo \Illuminate\Support\Js::from($this->defaultActionContext)->toHtml() ?> <?php endif; ?>)"
        ></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_END, scopes: $this->getRenderHookScopes())); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($this, 'hasUnsavedDataChangesAlert') && $this->hasUnsavedDataChangesAlert()): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\Filament\Support\Facades\FilamentView::hasSpaMode()): ?>
                <?php
        $__scriptKey = '2010543352-0';
        ob_start();
    ?>
                <script>
                    setUpSpaModeUnsavedDataChangesAlert({
                        body: <?php echo \Illuminate\Support\Js::from(__('filament-panels::unsaved-changes-alert.body'))->toHtml() ?>,
                        resolveLivewireComponentUsing: () => window.Livewire.find('<?php echo e($_instance->getId()); ?>'),
                        $wire,
                    })
                </script>
                <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
        <?php else: ?>
                <?php
        $__scriptKey = '2010543352-1';
        ob_start();
    ?>
                <script>
                    setUpUnsavedDataChangesAlert({ $wire })
                </script>
                <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! app()->hasDebugModeEnabled()): ?>
            <?php
        $__scriptKey = '2010543352-2';
        ob_start();
    ?>
            <script>
                window.filamentErrorNotifications = <?php echo \Illuminate\Support\Js::from($this->hasErrorNotifications() ? $this->getErrorNotifications() : null)->toHtml() ?>
            </script>
            <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal29f738301ffa464f2646caa32428c50f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29f738301ffa464f2646caa32428c50f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.unsaved-action-changes-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::unsaved-action-changes-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29f738301ffa464f2646caa32428c50f)): ?>
<?php $attributes = $__attributesOriginal29f738301ffa464f2646caa32428c50f; ?>
<?php unset($__attributesOriginal29f738301ffa464f2646caa32428c50f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29f738301ffa464f2646caa32428c50f)): ?>
<?php $component = $__componentOriginal29f738301ffa464f2646caa32428c50f; ?>
<?php unset($__componentOriginal29f738301ffa464f2646caa32428c50f); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/page/index.blade.php ENDPATH**/ ?>