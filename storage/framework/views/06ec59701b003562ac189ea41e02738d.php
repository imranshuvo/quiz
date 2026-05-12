<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'length' => 6,
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
    'length' => 6,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{ currentNumberOfDigits: null }"
    <?php echo e($attributes
            ->class([
                'fi-one-time-code-input-ctn',
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1, $length); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $digit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div
            x-bind:class="{
                'fi-active':
                    currentNumberOfDigits !== null &&
                    currentNumberOfDigits >= <?php echo e($digit); ?>,
            }"
            class="fi-one-time-code-input-digit-field"
        ></div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <input
        autocomplete="one-time-code"
        inputmode="numeric"
        minlength="<?php echo e($length); ?>"
        maxlength="<?php echo e($length); ?>"
        pattern="\d<?php echo e('{' . $length . '}'); ?>"
        type="text"
        x-data="{}"
        x-on:focus="currentNumberOfDigits = $el.value.length"
        x-on:blur="currentNumberOfDigits = null"
        x-on:input="
            $el.value = $el.value.replace(/\D/g, '')
            currentNumberOfDigits = $el.value.length
        "
        x-bind:class="{ 'fi-valid': currentNumberOfDigits >= <?php echo e($length); ?> }"
        <?php echo e($input?->attributes); ?>

        class="fi-one-time-code-input"
    />
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/support/resources/views/components/input/one-time-code.blade.php ENDPATH**/ ?>