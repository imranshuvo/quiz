

<?php
// Workaround: when `scroll-to` is forwarded via `:attributes` (e.g. from the table component
// using `attributesAfter`), Laravel doesn't convert the kebab-case `scroll-to` attribute to
// the camelCase `scrollTo` prop. `forwardedAttributes` handles this conversion manually.
extract(Flux::forwardedAttributes($attributes, ['scrollTo']));
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'paginator' => null,
    'scrollTo' => $scrollTo ?? null,
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
    'paginator' => null,
    'scrollTo' => $scrollTo ?? null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$simple = ! $paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator;

$scrollToSelector = $scrollTo === true ? 'body' : $scrollTo;

$scrollIntoViewJsSnippet = ($scrollTo !== null && $scrollTo !== false)
    ? "(\$el.closest('{$scrollToSelector}') || \$el.closest('body').querySelector('{$scrollToSelector}')).scrollIntoView()"
    : '';
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($simple): ?>
    <div <?php echo e($attributes->class('pt-3 border-t border-zinc-100 dark:border-zinc-700 flex justify-between items-center')); ?> data-flux-pagination>
        <div></div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
            <div class="flex items-center bg-white border border-zinc-200 rounded-[8px] p-[1px] dark:bg-white/10 dark:border-white/10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                    <div class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($paginator,'getCursorName')): ?>
                        <button type="button" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cursor-'.e($paginator->getCursorName()).'-'.e($paginator->previousCursor()->encode()).''; ?>wire:key="cursor-<?php echo e($paginator->getCursorName()); ?>-<?php echo e($paginator->previousCursor()->encode()); ?>" wire:click="setPage('<?php echo e($paginator->previousCursor()->encode()); ?>','<?php echo e($paginator->getCursorName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                            <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        </button>
                    <?php else: ?>
                        <button type="button" wire:click="previousPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                            <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($paginator,'getCursorName')): ?>
                        <button type="button" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cursor-'.e($paginator->getCursorName()).'-'.e($paginator->nextCursor()->encode()).''; ?>wire:key="cursor-<?php echo e($paginator->getCursorName()); ?>-<?php echo e($paginator->nextCursor()->encode()); ?>" wire:click="setPage('<?php echo e($paginator->nextCursor()->encode()); ?>','<?php echo e($paginator->getCursorName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                            <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        </button>
                    <?php else: ?>
                        <button type="button" wire:click="nextPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-white hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                            <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <div class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php else: ?>
    <div <?php echo e($attributes->class('@container pt-3 border-t border-zinc-100 dark:border-zinc-700 flex justify-between items-center gap-3')); ?> data-flux-pagination>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->total() > 0): ?>
            <div class="text-zinc-500 dark:text-zinc-400 text-xs font-medium whitespace-nowrap">
                <?php echo __('Showing'); ?> <?php echo e($paginator->firstItem()); ?> <?php echo __('to'); ?> <?php echo e($paginator->lastItem()); ?> <?php echo __('of'); ?> <?php echo e($paginator->total()); ?> <?php echo __('results'); ?>

            </div>
        <?php else: ?>
            <div></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
            
            <div class="flex @[40rem]:hidden items-center bg-white border border-zinc-200 rounded-[8px] p-[1px] dark:bg-white/10 dark:border-white/10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                    <div aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                    </div>
                <?php else: ?>
                    <button type="button" wire:click="previousPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" aria-label="<?php echo e(__('pagination.previous')); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                    <button type="button" wire:click="nextPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" aria-label="<?php echo e(__('pagination.next')); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-400 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                    </button>
                <?php else: ?>
                    <div aria-label="<?php echo e(__('pagination.next')); ?>" class="flex justify-center items-center size-8 sm:size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="hidden @[40rem]:flex items-center bg-white border border-zinc-200 rounded-[8px] p-[1px] dark:bg-white/10 dark:border-white/10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                    <div aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>" class="flex justify-center items-center size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                    </div>
                <?php else: ?>
                    <button type="button" wire:click="previousPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" aria-label="<?php echo e(__('pagination.previous')); ?>" class="flex justify-center items-center size-6 rounded-[6px] text-zinc-400 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \Livewire\invade($paginator)->elements(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_string($element)): ?>
                        <div
                            aria-disabled="true"
                            class="cursor-default flex justify-center items-center text-xs size-6 rounded-[6px] font-medium dark:text-zinc-400 text-zinc-400"
                        ><?php echo e($element); ?></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($element)): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page == $paginator->currentPage()): ?>
                                <div
                                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'paginator-'.e($paginator->getPageName()).'-page'.e($page).''; ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'paginator-'.e($paginator->getPageName()).'-page'.e($page).''; ?>wire:key="paginator-<?php echo e($paginator->getPageName()); ?>-page<?php echo e($page); ?>"
                                    aria-current="page"
                                    class="cursor-default flex justify-center items-center text-xs h-6 px-2 rounded-[6px] font-medium dark:text-white text-zinc-800"
                                ><?php echo e($page); ?></div>
                            <?php else: ?>
                                <button
                                    <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'paginator-'.e($paginator->getPageName()).'-page'.e($page).''; ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'paginator-'.e($paginator->getPageName()).'-page'.e($page).''; ?>wire:key="paginator-<?php echo e($paginator->getPageName()); ?>-page<?php echo e($page); ?>"
                                    wire:click="gotoPage(<?php echo e($page); ?>, '<?php echo e($paginator->getPageName()); ?>')"
                                    x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>"
                                    type="button"
                                    class="text-xs h-6 px-2 rounded-[6px] text-zinc-400 font-medium dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white"
                                ><?php echo e($page); ?></button>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                    <button type="button" wire:click="nextPage('<?php echo e($paginator->getPageName()); ?>')" x-on:click="<?php echo e($scrollIntoViewJsSnippet); ?>" aria-label="<?php echo e(__('pagination.next')); ?>" class="flex justify-center items-center size-6 rounded-[6px] text-zinc-400 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-white/20 hover:text-zinc-800 dark:hover:text-white">
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                    </button>
                <?php else: ?>
                    <div aria-label="<?php echo e(__('pagination.next')); ?>" class="flex justify-center items-center size-6 rounded-[6px] text-zinc-300 dark:text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-right','data' => ['variant' => 'micro','class' => 'rtl:hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'rtl:hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $attributes = $__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__attributesOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3)): ?>
<?php $component = $__componentOriginal31cb76c8d087d4f00797aeea7232b4c3; ?>
<?php unset($__componentOriginal31cb76c8d087d4f00797aeea7232b4c3); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal93e8a1cf63877447e3f60f50005ff258 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal93e8a1cf63877447e3f60f50005ff258 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-left','data' => ['variant' => 'micro','class' => 'hidden rtl:inline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'micro','class' => 'hidden rtl:inline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $attributes = $__attributesOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__attributesOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal93e8a1cf63877447e3f60f50005ff258)): ?>
<?php $component = $__componentOriginal93e8a1cf63877447e3f60f50005ff258; ?>
<?php unset($__componentOriginal93e8a1cf63877447e3f60f50005ff258); ?>
<?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/pagination.blade.php ENDPATH**/ ?>