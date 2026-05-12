

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'direction' => null,
    'sortable' => false,
    'sorted' => false,
    'align' => 'start',
    'sticky' => false,
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
    'direction' => null,
    'sortable' => false,
    'sorted' => false,
    'align' => 'start',
    'sticky' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$classes = Flux::classes()
    ->add('py-3 px-3 first:ps-0 last:pe-0')
    ->add('text-start text-sm font-medium text-zinc-800 dark:text-white')
    ->add('border-b border-zinc-800/10 dark:border-white/20')
    ->add(match($align) {
        'center' => 'group/center-align',
        'end' => 'group/end-align',
        // Right is @deprecated but needed for backwards compatibility...
        'right' => 'group/end-align',
        default => '',
    })
    ->add($sortable ? 'group/sortable' : '')
    ->add($sticky ? [
        'z-10',
        'first:sticky first:left-0',
        'last:sticky last:right-0',
        'first:after:w-8 first:after:absolute first:after:inset-y-0 first:after:right-0 first:after:translate-x-full first:after:pointer-events-none',
        'last:after:w-8 last:after:absolute last:after:inset-y-0 last:after:left-0 last:after:-translate-x-full last:after:pointer-events-none',
        'in-data-scrolled-right:first:after:inset-shadow-[8px_0px_8px_-8px_rgba(0,0,0,0.05)]',
        'in-data-scrolled-left:last:after:inset-shadow-[-8px_0px_8px_-8px_rgba(0,0,0,0.05)]',
    ]: '')
    // If the last column is sortable, remove the right negative margin that the sortable applies to itself, as the
    // negative margin caused the last column to overflow the table creating an unnecessary horizontal scrollbar...
    ->add('**:data-flux-table-sortable:last:me-0')
    ;
?>

<th <?php echo e($attributes->class($classes)); ?> data-flux-column>
    <?php if ($sortable): ?>
        <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end">
            <?php if (isset($component)) { $__componentOriginal46c2ce8187bb0010344b42a2b995e67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal46c2ce8187bb0010344b42a2b995e67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::table.sortable','data' => ['sorted' => $sorted,'direction' => $direction]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::table.sortable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['sorted' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sorted),'direction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($direction)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <div><?php echo e($slot); ?></div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal46c2ce8187bb0010344b42a2b995e67b)): ?>
<?php $attributes = $__attributesOriginal46c2ce8187bb0010344b42a2b995e67b; ?>
<?php unset($__attributesOriginal46c2ce8187bb0010344b42a2b995e67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal46c2ce8187bb0010344b42a2b995e67b)): ?>
<?php $component = $__componentOriginal46c2ce8187bb0010344b42a2b995e67b; ?>
<?php unset($__componentOriginal46c2ce8187bb0010344b42a2b995e67b); ?>
<?php endif; ?>
        </div>
    <?php else: ?>
        <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php echo e($slot); ?></div>
    <?php endif; ?>
</th>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/table/column.blade.php ENDPATH**/ ?>