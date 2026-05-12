

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'dismissible' => null,
    'position' => null,
    'closable' => null,
    'trigger' => null,
    'variant' => null,
    'scroll' => null,
    'flyout' => null,
    'name' => null,
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
    'dismissible' => null,
    'position' => null,
    'closable' => null,
    'trigger' => null,
    'variant' => null,
    'scroll' => null,
    'flyout' => null,
    'name' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
// Blaze doesn't support View::share, this supplements it...
$__livewire = $__env->shared('__livewire');

if ($variant === 'flyout') {
    $flyout = true;
    $variant = null;
}

$closable ??= $variant === 'bare' ? false : true;
$overflow = $scroll === 'body' && ! $flyout;

if ($flyout) {
    $classes = Flux::classes()
        ->add(match ($variant) {
            default => match($position) {
                // For bottom flyout we intentionally use 100% instead of 100vw because Firefox includes scrollbar gutter in vw...
                'bottom' => 'fixed m-0 p-8 min-w-[100%] overflow-y-auto mt-auto [--flux-flyout-translate:translateY(50px)] border-t',
                'left' => 'fixed m-0 p-8 max-h-dvh min-h-dvh md:[:where(&)]:min-w-[25rem] overflow-y-auto mr-auto [--flux-flyout-translate:translateX(-50px)] border-e rtl:mr-0 rtl:ml-auto rtl:[--flux-flyout-translate:translateX(50px)]',
                default => 'fixed m-0 p-8 max-h-dvh min-h-dvh md:[:where(&)]:min-w-[25rem] overflow-y-auto ml-auto [--flux-flyout-translate:translateX(50px)] border-s rtl:ml-0 rtl:mr-auto rtl:[--flux-flyout-translate:translateX(-50px)]',
            },
            'floating' => match($position) {
                // For bottom flyout we intentionally use 100% instead of 100vw because Firefox includes scrollbar gutter in vw...
                'bottom' => 'fixed m-2 p-8 min-w-[calc(100%-1rem)] overflow-y-auto mt-auto [--flux-flyout-translate:translateY(50px)]',
                'left' => 'fixed m-2 p-8 max-h-[calc(100dvh-1rem)] min-h-[calc(100dvh-1rem)] md:[:where(&)]:min-w-[25rem] overflow-y-auto mr-auto [--flux-flyout-translate:translateX(-50px)] rtl:mr-0 rtl:ml-auto rtl:[--flux-flyout-translate:translateX(50px)]',
                default => 'fixed m-2 p-8 max-h-[calc(100dvh-1rem)] min-h-[calc(100dvh-1rem)] md:[:where(&)]:min-w-[25rem] overflow-y-auto ml-auto [--flux-flyout-translate:translateX(50px)] rtl:ml-0 rtl:mr-auto rtl:[--flux-flyout-translate:translateX(-50px)]',
            },
            'bare' => '',
        })
        ->add(match ($variant) {
            default => 'bg-white dark:bg-zinc-800 border-transparent dark:border-zinc-700',
            'floating' => 'bg-white dark:bg-zinc-800 ring ring-black/5 dark:ring-zinc-700 shadow-lg rounded-xl',
            'bare' => 'bg-transparent',
        });
} elseif ($overflow) {
    $classes = Flux::classes();

    $contentClasses = Flux::classes()
        ->add('relative')
        ->add(match ($variant) {
            default => 'p-6 [:where(&)]:max-w-xl [:where(&)]:min-w-xs shadow-lg rounded-xl',
            'bare' => '',
        })
        ->add(match ($variant) {
            default => 'bg-white dark:bg-zinc-800 ring ring-black/5 dark:ring-zinc-700 shadow-lg rounded-xl',
            'bare' => 'bg-transparent',
        });
} else {
    $classes = Flux::classes()
        ->add(match ($variant) {
            default => 'p-6 [:where(&)]:max-w-xl [:where(&)]:min-w-xs shadow-lg rounded-xl',
            'bare' => '',
        })
        ->add(match ($variant) {
            default => 'bg-white dark:bg-zinc-800 ring ring-black/5 dark:ring-zinc-700 shadow-lg rounded-xl',
            'bare' => 'bg-transparent',
        });
}

// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}

if ($attributes['@close'] ?? null) {
    $attributes['wire:close'] = $attributes['@close'];

    unset($attributes['@close']);
}

if ($attributes['@cancel'] ?? null) {
    $attributes['wire:cancel'] = $attributes['@cancel'];

    unset($attributes['@cancel']);
}

if ($dismissible === false) {
    $attributes = $attributes->merge(['disable-click-outside' => '']);
}

[ $contentAttributes, $attributes ] = Flux::splitAttributes($attributes, ['autofocus', 'class', 'style']);
[ $dialogAttributes, $attributes ] = Flux::splitAttributes($attributes, ['wire:close', 'x-on:close', 'wire:cancel', 'x-on:cancel']);

if (! $overflow) {
    $dialogAttributes = $dialogAttributes->merge($contentAttributes->getAttributes());
}
?>

<ui-modal <?php echo e($attributes); ?> data-flux-modal>
    <?php if ($trigger): ?>
        <?php echo e($trigger); ?>

    <?php endif; ?>

    <dialog
        wire:ignore.self 
        <?php echo e($dialogAttributes->class($classes)); ?>

        <?php if ($name): ?> data-modal="<?php echo e($name); ?>" <?php endif; ?>
        <?php if ($flyout): ?> data-flux-flyout <?php endif; ?>
        <?php if ($overflow): ?> data-flux-modal-overflow <?php endif; ?>
        <?php $__getScope = fn($scope = []) => $scope; ?><?php if (isset($scope)) $__scope = $scope; ?><?php $scope = $__getScope(scope: ['name' => $name]); ?>
        x-data="fluxModal(<?php echo \Illuminate\Support\Js::from($scope['name'])->toHtml() ?>, <?php echo \Illuminate\Support\Js::from(isset($__livewire) ? $__livewire->getId() : null)->toHtml() ?>)"
        <?php if (isset($__scope)) { $scope = $__scope; unset($__scope); } ?>
        x-on:modal-show.document="handleShow($event)"
        x-on:modal-close.document="handleClose($event)"
    >
        <?php if ($overflow): ?>
            <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
                <div <?php echo e($contentAttributes->class($contentClasses)); ?> data-flux-modal-content>
                    <?php echo e($slot); ?>


                    <?php if ($closable): ?>
                        <div class="absolute top-0 end-0 mt-4 me-4">
                            <?php if (isset($component)) { $__componentOriginalda55eef372798476d918d03158796935 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda55eef372798476d918d03158796935 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.close','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'ghost','icon' => 'x-mark','size' => 'sm','ariaLabel' => ''.e(__('Close modal')).'','class' => 'text-zinc-400! hover:text-zinc-800! dark:text-zinc-500! dark:hover:text-white!']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','icon' => 'x-mark','size' => 'sm','aria-label' => ''.e(__('Close modal')).'','class' => 'text-zinc-400! hover:text-zinc-800! dark:text-zinc-500! dark:hover:text-white!']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda55eef372798476d918d03158796935)): ?>
<?php $attributes = $__attributesOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__attributesOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda55eef372798476d918d03158796935)): ?>
<?php $component = $__componentOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__componentOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php echo e($slot); ?>


            <?php if ($closable): ?>
                <div class="absolute top-0 end-0 mt-4 me-4">
                    <?php if (isset($component)) { $__componentOriginalda55eef372798476d918d03158796935 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda55eef372798476d918d03158796935 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::modal.close','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::modal.close'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'ghost','icon' => 'x-mark','size' => 'sm','ariaLabel' => ''.e(__('Close modal')).'','class' => 'text-zinc-400! hover:text-zinc-800! dark:text-zinc-500! dark:hover:text-white!']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','icon' => 'x-mark','size' => 'sm','aria-label' => ''.e(__('Close modal')).'','class' => 'text-zinc-400! hover:text-zinc-800! dark:text-zinc-500! dark:hover:text-white!']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda55eef372798476d918d03158796935)): ?>
<?php $attributes = $__attributesOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__attributesOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda55eef372798476d918d03158796935)): ?>
<?php $component = $__componentOriginalda55eef372798476d918d03158796935; ?>
<?php unset($__componentOriginalda55eef372798476d918d03158796935); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </dialog>
</ui-modal>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/src/../stubs/resources/views/flux/modal/index.blade.php ENDPATH**/ ?>