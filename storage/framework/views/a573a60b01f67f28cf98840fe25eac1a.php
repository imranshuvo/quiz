

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'align' => 'start',
    'variant' => null,
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
    'align' => 'start',
    'variant' => null,
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
    ->add('py-3 px-3 first:ps-0 last:pe-0 text-sm')
    ->add(match($align) {
        'center' => 'text-center',
        'end' => 'text-end',
        default => '',
    })
    ->add(match ($variant) {
        'strong' => 'font-medium text-zinc-800 dark:text-white',
        default => 'text-zinc-500 dark:text-zinc-300',
    })
    ->add($sticky ? [
        'z-10',
        'first:sticky first:left-0',
        'last:sticky last:right-0',
        'first:after:w-8 first:after:absolute first:after:inset-y-0 first:after:right-0 first:after:translate-x-full first:after:pointer-events-none',
        'last:after:w-8 last:after:absolute last:after:inset-y-0 last:after:left-0 last:after:-translate-x-full last:after:pointer-events-none',
        'in-data-scrolled-right:first:after:inset-shadow-[8px_0px_8px_-8px_rgba(0,0,0,0.05)]',
        'in-data-scrolled-left:last:after:inset-shadow-[-8px_0px_8px_-8px_rgba(0,0,0,0.05)]',
    ]: '')
    ->add('not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20')
    ;
?>

<td <?php echo e($attributes->class($classes)); ?> data-flux-cell>
    <?php echo e($slot); ?>

</td>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/table/cell.blade.php ENDPATH**/ ?>