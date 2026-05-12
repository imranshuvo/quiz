<?php
    $id = $getId();
    $key = $getKey();
    $wizard = $getContainer()->getParentComponent();
    $isContained = $wizard->isContained();
    $alpineSubmitHandler = $hasFormWrapper() ? $wizard->getAlpineSubmitHandler() : null;
?>

<<?php echo e(filled($alpineSubmitHandler) ? 'form' : 'div'); ?>

    x-bind:tabindex="$el.querySelector('[autofocus]') ? '-1' : '0'"
    x-bind:class="{
        'fi-active': step === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>,
    }"
    x-on:expand="
        if (! isStepAccessible(<?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>)) {
            return
        }

        step = <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>
    "
    <?php if(filled($alpineSubmitHandler)): ?>
        x-on:submit.prevent="isLastStep() ? <?php echo $alpineSubmitHandler; ?> : requestNextStep()"
    <?php endif; ?>
    x-cloak
    x-ref="step-<?php echo e($key); ?>"
    <?php echo e($attributes
            ->merge([
                'aria-labelledby' => $id,
                'id' => $id,
                'role' => 'tabpanel',
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class(['fi-sc-wizard-step'])); ?>

>
    <?php echo e($getChildSchema()); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($alpineSubmitHandler)): ?>
        
        <input type="submit" hidden />
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?php echo e(filled($alpineSubmitHandler) ? 'form' : 'div'); ?>>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/wizard/step.blade.php ENDPATH**/ ?>