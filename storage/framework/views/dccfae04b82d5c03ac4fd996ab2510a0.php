

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'accent' => true,
    'label' => null,
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
    'accent' => true,
    'label' => null,
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
    ->add('flex whitespace-nowrap gap-2 items-center py-1 px-2 rounded-full text-sm font-medium leading-4')
    ->add('bg-zinc-800/6 dark:bg-white/10 hover:bg-zinc-800/10 dark:hover:bg-white/15 text-zinc-800 hover:text-zinc-800 dark:text-white/70 dark:hover:text-white')
    ->add(match ($accent) {
        true => 'data-checked:bg-(--color-accent) hover:data-checked:bg-(--color-accent)',
        false => 'data-checked:bg-zinc-800 dark:data-checked:bg-white',
    })
    ->add(match ($accent) {
        true => 'data-checked:text-(--color-accent-foreground) hover:data-checked:text-(--color-accent-foreground)',
        false => 'data-checked:text-white dark:data-checked:text-zinc-800',
    })
    ->add('[&[disabled]]:opacity-50 dark:[&[disabled]]:opacity-75 [&[disabled]]:cursor-default [&[disabled]]:pointer-events-none')
    ;
?>




<ui-radio <?php echo e($attributes->class($classes)); ?> data-flux-control data-flux-radio-pills tabindex="-1" data-flux-field>
    <?php echo e($slot->isNotEmpty() ? $slot : $label); ?>

</ui-radio>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/radio/variants/pills.blade.php ENDPATH**/ ?>