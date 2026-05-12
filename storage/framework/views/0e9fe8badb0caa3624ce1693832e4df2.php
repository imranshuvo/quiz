<?php
    use Filament\Actions\Action;
    use Filament\Actions\ActionGroup;
    use Filament\Schemas\Components\Component;
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Enums\VerticalAlignment;

    $statePath = $getStatePath();

    $fromBreakpoint = $getFromBreakpoint();
    $verticalAlignment = $getVerticalAlignment();
    $alignment = $getAlignment();

    if (! $verticalAlignment instanceof VerticalAlignment) {
        $verticalAlignment = filled($verticalAlignment) ? (VerticalAlignment::tryFrom($verticalAlignment) ?? $verticalAlignment) : null;
    }

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }
?>

<div
    <?php echo e($attributes
            ->merge($getExtraAttributes(), escape: false)
            ->class([
                'fi-sc-flex',
                'fi-dense' => $isDense(),
                'fi-from-' . ($fromBreakpoint ?? 'default'),
                ($verticalAlignment instanceof VerticalAlignment) ? "fi-vertical-align-{$verticalAlignment->value}" : $verticalAlignment,
                ($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : $alignment,
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $getChildSchema()->getComponents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schemaComponent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($schemaComponent instanceof Action) || ($schemaComponent instanceof ActionGroup)): ?>
            <div>
                <?php echo e($schemaComponent); ?>

            </div>
        <?php else: ?>
            <?php
                $hiddenJs = $schemaComponent->getHiddenJs();
                $visibleJs = $schemaComponent->getVisibleJs();

                $schemaComponentStatePath = $schemaComponent->getStatePath();
            ?>

            <div
                x-data="filamentSchemaComponent({
                            path: <?php echo \Illuminate\Support\Js::from($schemaComponentStatePath)->toHtml() ?>,
                            containerPath: <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?>,
                            $wire,
                        })"
                <?php if($afterStateUpdatedJs = $schemaComponent->getAfterStateUpdatedJs()): ?>
                    x-init="<?php echo implode(';', array_map(
                        fn (string $js): string => '$wire; $wire.watch(' . Js::from($schemaComponentStatePath) . ', ($state, $old) => isStateChanged($state, $old) && eval(' . Js::from($js) . '))',
                        $afterStateUpdatedJs,
                    )); ?>"
                <?php endif; ?>
                <?php if(filled($visibilityJs = match ([filled($hiddenJs), filled($visibleJs)]) {
                         [true, true] => "(! ({$hiddenJs})) && ({$visibleJs})",
                         [true, false] => "! ({$hiddenJs})",
                         [false, true] => $visibleJs,
                         default => null,
                     })): ?>
                    x-bind:class="{ 'fi-hidden': ! (<?php echo $visibilityJs; ?>) }"
                    x-cloak
                <?php endif; ?>
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-growable' => ($schemaComponent instanceof Component) && $schemaComponent->canGrow(),
                ]); ?>"
            >
                <?php echo e($schemaComponent); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/flex.blade.php ENDPATH**/ ?>