<?php
    $isContained = $isContained();
    $key = $getKey();
    $previousAction = $getAction('previous');
    $nextAction = $getAction('next');
    $steps = $getChildSchema()->getComponents();
    $isHeaderHidden = $isHeaderHidden();
?>

<div
    x-load
    x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('wizard', 'filament/schemas')); ?>"
    x-data="wizardSchemaComponent({
                isSkippable: <?php echo \Illuminate\Support\Js::from($isSkippable())->toHtml() ?>,
                isStepPersistedInQueryString: <?php echo \Illuminate\Support\Js::from($isStepPersistedInQueryString())->toHtml() ?>,
                key: <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>,
                livewireId: <?php echo \Illuminate\Support\Js::from($this->getId())->toHtml() ?>,
                schemaKey: <?php echo \Illuminate\Support\Js::from($getRootContainer()->getKey())->toHtml() ?>,
                startStep: <?php echo \Illuminate\Support\Js::from($getStartStep())->toHtml() ?>,
                stepQueryStringKey: <?php echo \Illuminate\Support\Js::from($getStepQueryStringKey())->toHtml() ?>,
            })"
    x-on:next-wizard-step.window="if ($event.detail.key === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>) goToNextStep()"
    x-on:go-to-wizard-step.window="$event.detail.key === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?> && goToStep($event.detail.step)"
    wire:ignore.self
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->merge($getExtraAlpineAttributes(), escape: false)
            ->class([
                'fi-sc-wizard',
                'fi-contained' => $isContained,
                'fi-sc-wizard-header-hidden' => $isHeaderHidden,
            ])); ?>

>
    <input
        type="hidden"
        value="<?php echo e(collect($steps)
                ->filter(static fn (\Filament\Schemas\Components\Wizard\Step $step): bool => $step->isVisible())
                ->map(static fn (\Filament\Schemas\Components\Wizard\Step $step): ?string => $step->getKey())
                ->values()
                ->toJson()); ?>"
        x-ref="stepsData"
    />

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isHeaderHidden): ?>
        <ol
            <?php if(filled($label = $getLabel())): ?>
                aria-label="<?php echo e($label); ?>"
            <?php endif; ?>
            role="list"
            x-cloak
            x-ref="header"
            class="fi-sc-wizard-header"
        >
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <li
                    class="fi-sc-wizard-header-step"
                    x-bind:class="{
                        'fi-active': getStepIndex(step) === <?php echo e($loop->index); ?>,
                        'fi-completed': getStepIndex(step) > <?php echo e($loop->index); ?>,
                    }"
                >
                    <button
                        type="button"
                        x-bind:aria-current="getStepIndex(step) === <?php echo e($loop->index); ?> ? 'step' : null"
                        x-on:click="step = <?php echo \Illuminate\Support\Js::from($step->getKey())->toHtml() ?>"
                        x-bind:disabled="! isStepAccessible(<?php echo \Illuminate\Support\Js::from($step->getKey())->toHtml() ?>) || <?php echo \Illuminate\Support\Js::from($previousAction->isDisabled())->toHtml() ?>"
                        class="fi-sc-wizard-header-step-btn"
                    >
                        <div class="fi-sc-wizard-header-step-icon-ctn">
                            <?php
                                $completedIcon = $step->getCompletedIcon();
                            ?>

                            <?php echo e(\Filament\Support\generate_icon_html(
                                    $completedIcon ?? \Filament\Support\Icons\Heroicon::OutlinedCheck,
                                    alias: filled($completedIcon) ? null : \Filament\Schemas\View\SchemaIconAlias::COMPONENTS_WIZARD_COMPLETED_STEP,
                                    attributes: new \Illuminate\View\ComponentAttributeBag([
                                        'x-cloak' => 'x-cloak',
                                        'x-show' => "getStepIndex(step) > {$loop->index}",
                                    ]),
                                    size: \Filament\Support\Enums\IconSize::Large,
                                )); ?>


                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($icon = $step->getIcon())): ?>
                                <?php echo e(\Filament\Support\generate_icon_html(
                                        $icon,
                                        attributes: new \Illuminate\View\ComponentAttributeBag([
                                            'x-cloak' => 'x-cloak',
                                            'x-show' => "getStepIndex(step) <= {$loop->index}",
                                        ]),
                                        size: \Filament\Support\Enums\IconSize::Large,
                                    )); ?>

                            <?php else: ?>
                                <span
                                    x-show="getStepIndex(step) <= <?php echo e($loop->index); ?>"
                                    class="fi-sc-wizard-header-step-number"
                                >
                                    <?php echo e(str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT)); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="fi-sc-wizard-header-step-text">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $step->isLabelHidden()): ?>
                                <span class="fi-sc-wizard-header-step-label">
                                    <?php echo e($step->getLabel()); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($description = $step->getDescription())): ?>
                                <span
                                    class="fi-sc-wizard-header-step-description"
                                >
                                    <?php echo e($description); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </button>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $loop->last): ?>
                        <svg
                            fill="none"
                            preserveAspectRatio="none"
                            viewBox="0 0 22 80"
                            aria-hidden="true"
                            class="fi-sc-wizard-header-step-separator"
                        >
                            <path
                                d="M0 -2L20 40L0 82"
                                stroke-linejoin="round"
                                stroke="currentcolor"
                                vector-effect="non-scaling-stroke"
                            ></path>
                        </svg>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </ol>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php echo e($step); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <div x-cloak class="fi-sc-wizard-footer">
        <div
            x-cloak
            <?php if(! $previousAction->isDisabled()): ?>
                x-on:click="goToPreviousStep"
            <?php endif; ?>
            x-show="! isFirstStep()"
        >
            <?php echo e($previousAction); ?>

        </div>

        <div x-show="isFirstStep()">
            <?php echo e($getCancelAction()); ?>

        </div>

        <div
            x-cloak
            <?php if(! $nextAction->isDisabled()): ?>
                x-on:click="requestNextStep()"
            <?php endif; ?>
            x-bind:class="{ 'fi-hidden': isLastStep() }"
            wire:loading.class="fi-disabled"
        >
            <?php echo e($nextAction); ?>

        </div>

        <div x-bind:class="{ 'fi-hidden': ! isLastStep() }">
            <?php echo e($getSubmitAction()); ?>

        </div>
    </div>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/wizard.blade.php ENDPATH**/ ?>