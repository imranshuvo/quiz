<?php
    use Filament\Support\Enums\Width;

    $livewire ??= null;

    $hasTopbar = filament()->hasTopbar();
    $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
    $isSidebarFullyCollapsibleOnDesktop = filament()->isSidebarFullyCollapsibleOnDesktop();
    $hasTopNavigation = filament()->hasTopNavigation();
    $hasNavigation = filament()->hasNavigation();
    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getMaxContentWidth() ?? Width::SevenExtraLarge);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }
?>

<?php if (isset($component)) { $__componentOriginale960ae7ad1b1ce9e3596e483505fadc9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.layout.base','data' => ['livewire' => $livewire,'class' => \Illuminate\Support\Arr::toCssClasses([
        'fi-body-has-navigation' => $hasNavigation,
        'fi-body-has-sidebar-collapsible-on-desktop' => $isSidebarCollapsibleOnDesktop,
        'fi-body-has-sidebar-fully-collapsible-on-desktop' => $isSidebarFullyCollapsibleOnDesktop,
        'fi-body-has-topbar' => $hasTopbar,
        'fi-body-has-top-navigation' => $hasTopNavigation,
    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::layout.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($livewire),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
        'fi-body-has-navigation' => $hasNavigation,
        'fi-body-has-sidebar-collapsible-on-desktop' => $isSidebarCollapsibleOnDesktop,
        'fi-body-has-sidebar-fully-collapsible-on-desktop' => $isSidebarFullyCollapsibleOnDesktop,
        'fi-body-has-topbar' => $hasTopbar,
        'fi-body-has-top-navigation' => $hasTopNavigation,
    ]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasTopbar): ?>
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_BEFORE, scopes: $renderHookScopes)); ?>


        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(filament()->getTopbarLivewireComponent());

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1349427256-0', $__key);

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

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_AFTER, scopes: $renderHookScopes)); ?>

    <?php elseif($hasNavigation): ?>
        <div
            <?php if($isSidebarFullyCollapsibleOnDesktop): ?>
                x-data="{}"
                x-bind:class="{ 'lg:fi-hidden': $store.sidebar.isOpen }"
            <?php endif; ?>
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-layout-sidebar-toggle-btn-ctn',
                'lg:fi-hidden' => ! $isSidebarFullyCollapsibleOnDesktop,
            ]); ?>"
        >
            <?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['color' => 'gray','icon' => \Filament\Support\Icons\Heroicon::OutlinedBars3,'iconAlias' => \Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.sidebar.expand.label'),'xCloak' => true,'xData' => '{}','xOn:click' => '$store.sidebar.open()','class' => 'fi-layout-sidebar-toggle-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::OutlinedBars3),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\View\PanelsIconAlias::SIDEBAR_EXPAND_BUTTON),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.sidebar.expand.label')),'x-cloak' => true,'x-data' => '{}','x-on:click' => '$store.sidebar.open()','class' => 'fi-layout-sidebar-toggle-btn']); ?>
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
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="fi-layout">
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::LAYOUT_START, scopes: $renderHookScopes)); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasNavigation): ?>
            <div
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                x-transition.opacity.300ms
                class="fi-sidebar-close-overlay"
            ></div>

            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(filament()->getSidebarLivewireComponent());

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1349427256-1', $__key);

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

        <div
            <?php if($isSidebarCollapsibleOnDesktop): ?>
                x-data="{}"
                x-bind:class="{
                    'fi-main-ctn-sidebar-open': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex; opacity:1;'"
                
            <?php elseif($isSidebarFullyCollapsibleOnDesktop): ?>
                x-data="{}"
                x-bind:class="{
                    'fi-main-ctn-sidebar-open': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex; opacity:1;'"
                
            <?php elseif(! ($isSidebarCollapsibleOnDesktop || $isSidebarFullyCollapsibleOnDesktop || $hasTopNavigation || (! $hasNavigation))): ?>
                x-data="{}"
                x-bind:style="'display: flex; opacity:1;'" 
            <?php endif; ?>
            class="fi-main-ctn"
        >
            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_BEFORE, scopes: $renderHookScopes)); ?>


            <main
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-main',
                    ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                ]); ?>"
            >
                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_START, scopes: $renderHookScopes)); ?>


                <?php echo e($slot); ?>


                <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_END, scopes: $renderHookScopes)); ?>

            </main>

            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::CONTENT_AFTER, scopes: $renderHookScopes)); ?>


            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes)); ?>

        </div>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::LAYOUT_END, scopes: $renderHookScopes)); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9)): ?>
<?php $attributes = $__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9; ?>
<?php unset($__attributesOriginale960ae7ad1b1ce9e3596e483505fadc9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960ae7ad1b1ce9e3596e483505fadc9)): ?>
<?php $component = $__componentOriginale960ae7ad1b1ce9e3596e483505fadc9; ?>
<?php unset($__componentOriginale960ae7ad1b1ce9e3596e483505fadc9); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/layout/index.blade.php ENDPATH**/ ?>