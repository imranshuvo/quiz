<?php
    use Filament\Support\Enums\VerticalAlignment;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'areHtmlErrorMessagesAllowed' => null,
    'errorMessage' => null,
    'errorMessages' => null,
    'field' => null,
    'hasErrors' => true,
    'hasInlineLabel' => null,
    'hasNestedRecursiveValidationRules' => null,
    'id' => null,
    'inlineLabelVerticalAlignment' => VerticalAlignment::Start,
    'isDisabled' => null,
    'label' => null,
    'labelPrefix' => null,
    'labelSrOnly' => null,
    'labelSuffix' => null,
    'labelTag' => 'label',
    'required' => null,
    'shouldShowAllValidationMessages' => null,
    'statePath' => null,
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
    'areHtmlErrorMessagesAllowed' => null,
    'errorMessage' => null,
    'errorMessages' => null,
    'field' => null,
    'hasErrors' => true,
    'hasInlineLabel' => null,
    'hasNestedRecursiveValidationRules' => null,
    'id' => null,
    'inlineLabelVerticalAlignment' => VerticalAlignment::Start,
    'isDisabled' => null,
    'label' => null,
    'labelPrefix' => null,
    'labelSrOnly' => null,
    'labelSuffix' => null,
    'labelTag' => 'label',
    'required' => null,
    'shouldShowAllValidationMessages' => null,
    'statePath' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use Illuminate\Support\Arr;

    if ($field) {
        $hasInlineLabel ??= $field->hasInlineLabel();
        $hasNestedRecursiveValidationRules ??= $field instanceof \Filament\Forms\Components\Contracts\HasNestedRecursiveValidationRules;
        $id ??= $field->getId();
        $isDisabled ??= $field->isDisabled();
        $label ??= $field->getLabel();
        $labelSrOnly ??= $field->isLabelHidden();
        $required ??= $field->isMarkedAsRequired();
        $statePath ??= $field->getStatePath();
        $areHtmlErrorMessagesAllowed ??= $field->areHtmlValidationMessagesAllowed();
        $shouldShowAllValidationMessages ??= $field->shouldShowAllValidationMessages();
    }

    $aboveLabelSchema = $field?->getChildSchema($field::ABOVE_LABEL_SCHEMA_KEY)?->toHtmlString();
    $belowLabelSchema = $field?->getChildSchema($field::BELOW_LABEL_SCHEMA_KEY)?->toHtmlString();
    $beforeLabelSchema = $field?->getChildSchema($field::BEFORE_LABEL_SCHEMA_KEY)?->toHtmlString();
    $afterLabelSchema = $field?->getChildSchema($field::AFTER_LABEL_SCHEMA_KEY)?->toHtmlString();
    $aboveContentSchema = $field?->getChildSchema($field::ABOVE_CONTENT_SCHEMA_KEY)?->toHtmlString();
    $belowContentSchema = $field?->getChildSchema($field::BELOW_CONTENT_SCHEMA_KEY)?->toHtmlString();
    $beforeContentSchema = $field?->getChildSchema($field::BEFORE_CONTENT_SCHEMA_KEY)?->toHtmlString();
    $afterContentSchema = $field?->getChildSchema($field::AFTER_CONTENT_SCHEMA_KEY)?->toHtmlString();
    $aboveErrorMessageSchema = $field?->getChildSchema($field::ABOVE_ERROR_MESSAGE_SCHEMA_KEY)?->toHtmlString();
    $belowErrorMessageSchema = $field?->getChildSchema($field::BELOW_ERROR_MESSAGE_SCHEMA_KEY)?->toHtmlString();

    $hasError = $hasErrors && (filled($errorMessage) || filled($errorMessages) || (filled($statePath) && ($errors->has($statePath) || ($hasNestedRecursiveValidationRules && $errors->has("{$statePath}.*")))));

    if ($hasError && filled($statePath) && blank($errorMessage) && blank($errorMessages)) {
        if ($shouldShowAllValidationMessages) {
            $errorMessages = $errors->has($statePath) ? $errors->get($statePath) : ($hasNestedRecursiveValidationRules ? $errors->get("{$statePath}.*") : []);

            if (count($errorMessages) === 1) {
                $errorMessage = Arr::first($errorMessages);
                $errorMessages = [];
            }
        } else {
            $errorMessage = $errors->has($statePath) ? $errors->first($statePath) : ($hasNestedRecursiveValidationRules ? $errors->first("{$statePath}.*") : null);
        }
    }
?>

<div
    data-field-wrapper
    <?php echo e($attributes
            ->merge($field?->getExtraFieldWrapperAttributes() ?? [], escape: false)
            ->class([
                'fi-fo-field',
                'fi-fo-field-has-inline-label' => $hasInlineLabel,
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($label) && $labelSrOnly): ?>
        <<?php echo e($labelTag); ?>

            <?php if($labelTag === 'label'): ?>
                for="<?php echo e($id); ?>"
            <?php else: ?>
                id="<?php echo e($id); ?>-label"
            <?php endif; ?>
            class="fi-fo-field-label fi-sr-only"
        >
            <?php echo e($label); ?>

        </<?php echo e($labelTag); ?>>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((filled($label) && (! $labelSrOnly)) || $hasInlineLabel || $aboveLabelSchema || $belowLabelSchema || $beforeLabelSchema || $afterLabelSchema || $labelPrefix || $labelSuffix): ?>
        <div
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-fo-field-label-col',
                "fi-vertical-align-{$inlineLabelVerticalAlignment->value}" => $hasInlineLabel,
            ]); ?>"
        >
            <?php echo e($aboveLabelSchema); ?>


            <div
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-fo-field-label-ctn',
                    ($label instanceof \Illuminate\View\ComponentSlot) ? $label->attributes->get('class') : null,
                ]); ?>"
            >
                <?php echo e($beforeLabelSchema); ?>


                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((filled($label) && (! $labelSrOnly)) || $labelPrefix || $labelSuffix): ?>
                    <<?php echo e($labelTag); ?>

                        <?php if($labelTag === 'label'): ?>
                            for="<?php echo e($id); ?>"
                        <?php else: ?>
                            id="<?php echo e($id); ?>-label"
                        <?php endif; ?>
                        class="fi-fo-field-label"
                    >
                        <?php echo e($labelPrefix); ?>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($label) && (! $labelSrOnly)): ?>
                            <span class="fi-fo-field-label-content">
                                <?php echo e($label); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($required && (! $isDisabled)): ?><sup class="fi-fo-field-label-required-mark">*</sup>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php echo e($labelSuffix); ?>

                    </<?php echo e($labelTag); ?>>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e($afterLabelSchema); ?>

            </div>

            <?php echo e($belowLabelSchema); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((! \Filament\Support\is_slot_empty($slot)) || $hasError || $aboveContentSchema || $belowContentSchema || $beforeContentSchema || $afterContentSchema || $aboveErrorMessageSchema || $belowErrorMessageSchema): ?>
        <div class="fi-fo-field-content-col">
            <?php echo e($aboveContentSchema); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($beforeContentSchema || $afterContentSchema): ?>
                <div class="fi-fo-field-content-ctn">
                    <?php echo e($beforeContentSchema); ?>


                    <div class="fi-fo-field-content">
                        <?php echo e($slot); ?>

                    </div>

                    <?php echo e($afterContentSchema); ?>

                </div>
            <?php else: ?>
                <?php echo e($slot); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e($belowContentSchema); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasError): ?>
                <?php echo e($aboveErrorMessageSchema); ?>


                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($errorMessages)): ?>
                    <ul
                        data-validation-error
                        class="fi-fo-field-wrp-error-list"
                    >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errorMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $errorMessage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <li class="fi-fo-field-wrp-error-message">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($areHtmlErrorMessagesAllowed): ?>
                                    <?php echo $errorMessage; ?>

                                <?php else: ?>
                                    <?php echo e($errorMessage); ?>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                <?php elseif($areHtmlErrorMessagesAllowed): ?>
                    <div
                        data-validation-error
                        class="fi-fo-field-wrp-error-message"
                    >
                        <?php echo $errorMessage; ?>

                    </div>
                <?php else: ?>
                    <p
                        data-validation-error
                        class="fi-fo-field-wrp-error-message"
                    >
                        <?php echo e($errorMessage); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e($belowErrorMessageSchema); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/forms/resources/views/components/field-wrapper.blade.php ENDPATH**/ ?>