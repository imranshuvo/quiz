

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'color' => null,
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
    'color' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$trackClasses = Flux::classes()
    ->add('h-1.5 relative w-full overflow-hidden bg-zinc-200 dark:bg-white/10')
    ->add('[print-color-adjust:exact]')
    ->add('rounded-full')
    ->add(match ($color) {
        'red'     => '[--flux-progress-color:var(--color-red-600)] dark:[--flux-progress-color:var(--color-red-400)]',
        'orange'  => '[--flux-progress-color:var(--color-orange-600)] dark:[--flux-progress-color:var(--color-orange-400)]',
        'amber'   => '[--flux-progress-color:var(--color-amber-600)] dark:[--flux-progress-color:var(--color-amber-400)]',
        'yellow'  => '[--flux-progress-color:var(--color-yellow-600)] dark:[--flux-progress-color:var(--color-yellow-400)]',
        'lime'    => '[--flux-progress-color:var(--color-lime-600)] dark:[--flux-progress-color:var(--color-lime-400)]',
        'green'   => '[--flux-progress-color:var(--color-green-600)] dark:[--flux-progress-color:var(--color-green-400)]',
        'emerald' => '[--flux-progress-color:var(--color-emerald-600)] dark:[--flux-progress-color:var(--color-emerald-400)]',
        'teal'    => '[--flux-progress-color:var(--color-teal-600)] dark:[--flux-progress-color:var(--color-teal-400)]',
        'cyan'    => '[--flux-progress-color:var(--color-cyan-600)] dark:[--flux-progress-color:var(--color-cyan-400)]',
        'sky'     => '[--flux-progress-color:var(--color-sky-600)] dark:[--flux-progress-color:var(--color-sky-400)]',
        'blue'    => '[--flux-progress-color:var(--color-blue-600)] dark:[--flux-progress-color:var(--color-blue-400)]',
        'indigo'  => '[--flux-progress-color:var(--color-indigo-600)] dark:[--flux-progress-color:var(--color-indigo-400)]',
        'violet'  => '[--flux-progress-color:var(--color-violet-600)] dark:[--flux-progress-color:var(--color-violet-400)]',
        'purple'  => '[--flux-progress-color:var(--color-purple-600)] dark:[--flux-progress-color:var(--color-purple-400)]',
        'fuchsia' => '[--flux-progress-color:var(--color-fuchsia-600)] dark:[--flux-progress-color:var(--color-fuchsia-400)]',
        'pink'    => '[--flux-progress-color:var(--color-pink-600)] dark:[--flux-progress-color:var(--color-pink-400)]',
        'rose'    => '[--flux-progress-color:var(--color-rose-600)] dark:[--flux-progress-color:var(--color-rose-400)]',
        default   => '[--flux-progress-color:var(--color-accent)]',
    })
    ;

$barClasses = Flux::classes()
    ->add('h-full rounded-full transition-[width] duration-300 ease-out')
    ->add('bg-[var(--flux-progress-color)]')
    ;
?>

<ui-progress <?php echo e($attributes->class($trackClasses)); ?> data-flux-progress>
    <div class="<?php echo e($barClasses); ?>" style="width: var(--flux-progress-percentage)"></div>
</ui-progress>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/livewire/flux/stubs/resources/views/flux/progress.blade.php ENDPATH**/ ?>