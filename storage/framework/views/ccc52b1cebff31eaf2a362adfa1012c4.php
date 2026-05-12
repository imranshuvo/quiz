<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'navigation',
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
    'navigation',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    <?php echo e($attributes->class(['fi-page-sub-navigation-sidebar-ctn'])); ?>

>
    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SIDEBAR_BEFORE, scopes: $this->getRenderHookScopes())); ?>


    <ul class="fi-page-sub-navigation-sidebar">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $isNavigationGroupActive = $navigationGroup->isActive();
                $isNavigationGroupCollapsible = $navigationGroup->isCollapsible();
                $navigationGroupIcon = $navigationGroup->getIcon();
                $navigationGroupItems = $navigationGroup->getItems();
                $navigationGroupLabel = $navigationGroup->getLabel();
                $navigationGroupExtraSidebarAttributeBag = $navigationGroup->getExtraSidebarAttributeBag();
            ?>

            <?php if (isset($component)) { $__componentOriginal59b772cc9788bdb14bf9872624b4f33a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59b772cc9788bdb14bf9872624b4f33a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.sidebar.group','data' => ['active' => $isNavigationGroupActive,'collapsible' => $isNavigationGroupCollapsible,'icon' => $navigationGroupIcon,'items' => $navigationGroupItems,'label' => $navigationGroupLabel,'sidebarCollapsible' => false,'subNavigation' => true,'attributes' => \Filament\Support\prepare_inherited_attributes($navigationGroupExtraSidebarAttributeBag)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::sidebar.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isNavigationGroupActive),'collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isNavigationGroupCollapsible),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroupIcon),'items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroupItems),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($navigationGroupLabel),'sidebar-collapsible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'sub-navigation' => true,'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($navigationGroupExtraSidebarAttributeBag))]); ?>
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

    <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_SUB_NAVIGATION_SIDEBAR_AFTER, scopes: $this->getRenderHookScopes())); ?>

</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/page/sub-navigation/sidebar.blade.php ENDPATH**/ ?>