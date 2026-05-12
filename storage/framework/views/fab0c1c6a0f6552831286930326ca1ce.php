<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'actions' => [],
    'actionsAlignment' => null,
    'breadcrumbs' => [],
    'heading' => null,
    'subheading' => null,
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
    'actions' => [],
    'actionsAlignment' => null,
    'breadcrumbs' => [],
    'heading' => null,
    'subheading' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<header
    <?php echo e($attributes->class([
            'fi-header',
            'fi-header-has-breadcrumbs' => $breadcrumbs,
        ])); ?>

>
    <div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($breadcrumbs): ?>
            <?php if (isset($component)) { $__componentOriginale1cebc129855f156aa8f78d22103aca1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1cebc129855f156aa8f78d22103aca1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.breadcrumbs','data' => ['breadcrumbs' => $breadcrumbs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1cebc129855f156aa8f78d22103aca1)): ?>
<?php $attributes = $__attributesOriginale1cebc129855f156aa8f78d22103aca1; ?>
<?php unset($__attributesOriginale1cebc129855f156aa8f78d22103aca1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1cebc129855f156aa8f78d22103aca1)): ?>
<?php $component = $__componentOriginale1cebc129855f156aa8f78d22103aca1; ?>
<?php unset($__componentOriginale1cebc129855f156aa8f78d22103aca1); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_HEADING_BEFORE, scopes: $this->getRenderHookScopes())); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($heading)): ?>
            <h1 class="fi-header-heading">
                <?php echo e($heading); ?>

            </h1>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_HEADING_AFTER, scopes: $this->getRenderHookScopes())); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($subheading)): ?>
            <p class="fi-header-subheading">
                <?php echo e($subheading); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php
        $beforeActions = \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE, scopes: $this->getRenderHookScopes());
        $afterActions = \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::PAGE_HEADER_ACTIONS_AFTER, scopes: $this->getRenderHookScopes());
    ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($beforeActions) || $actions || filled($afterActions)): ?>
        <div class="fi-header-actions-ctn">
            <?php echo e($beforeActions); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($actions): ?>
                <?php if (isset($component)) { $__componentOriginal59d80b1aec4ae4c914a3e52dede19504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal59d80b1aec4ae4c914a3e52dede19504 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.actions','data' => ['actions' => $actions,'alignment' => $actionsAlignment]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsAlignment)]); ?>
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e($afterActions); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</header>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/header/index.blade.php ENDPATH**/ ?>