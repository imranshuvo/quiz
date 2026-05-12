<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'alignment' => null,
    'entry' => null,
    'hasInlineLabel' => null,
    'label' => null,
    'labelSrOnly' => null,
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
    'alignment' => null,
    'entry' => null,
    'hasInlineLabel' => null,
    'label' => null,
    'labelSrOnly' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use Filament\Support\Enums\Alignment;
    use Illuminate\View\ComponentAttributeBag;

    if ($entry) {
        $action ??= $entry->getAction();
        $alignment ??= $entry->getAlignment();
        $hasInlineLabel ??= $entry->hasInlineLabel();
        $label ??= $entry->getLabel();
        $labelSrOnly ??= $entry->isLabelHidden();
        $url ??= $entry->getUrl();
        $shouldOpenUrlInNewTab ??= $entry->shouldOpenUrlInNewTab();
    }

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }

    $beforeLabelContainer = $entry?->getChildSchema($entry::BEFORE_LABEL_SCHEMA_KEY)?->toHtmlString();
    $afterLabelContainer = $entry?->getChildSchema($entry::AFTER_LABEL_SCHEMA_KEY)?->toHtmlString();
    $beforeContentContainer = $entry?->getChildSchema($entry::BEFORE_CONTENT_SCHEMA_KEY)?->toHtmlString();
    $afterContentContainer = $entry?->getChildSchema($entry::AFTER_CONTENT_SCHEMA_KEY)?->toHtmlString();
?>

<div
    <?php echo e($attributes
            ->merge($entry?->getExtraEntryWrapperAttributes() ?? [], escape: false)
            ->class([
                'fi-in-entry',
                'fi-in-entry-has-inline-label' => $hasInlineLabel,
            ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label && $labelSrOnly): ?>
        <div class="fi-in-entry-label fi-sr-only" role="term">
            <?php echo e($label); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="fi-in-entry-label-col">
        <?php echo e($entry?->getChildSchema($entry::ABOVE_LABEL_SCHEMA_KEY)); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($label && (! $labelSrOnly)) || $beforeLabelContainer || $afterLabelContainer): ?>
            <div
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'fi-in-entry-label-ctn',
                    ($label instanceof \Illuminate\View\ComponentSlot) ? $label->attributes->get('class') : null,
                ]); ?>"
            >
                <?php echo e($beforeLabelContainer); ?>


                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label && (! $labelSrOnly)): ?>
                    <div
                        <?php echo e((
                                ($label instanceof \Illuminate\View\ComponentSlot)
                                ? $label->attributes
                                : (new ComponentAttributeBag)
                            )
                                ->class(['fi-in-entry-label'])); ?>

                        role="term"
                    >
                        <?php echo e($label); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo e($afterLabelContainer); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo e($entry?->getChildSchema($entry::BELOW_LABEL_SCHEMA_KEY)); ?>

    </div>

    <div class="fi-in-entry-content-col">
        <?php echo e($entry?->getChildSchema($entry::ABOVE_CONTENT_SCHEMA_KEY)); ?>


        <div class="fi-in-entry-content-ctn" role="definition">
            <?php echo e($beforeContentContainer); ?>


            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filled($url)): ?>
                <a
                    <?php echo e(\Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab)); ?>

                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'fi-in-entry-content',
                        (($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : (is_string($alignment) ? $alignment : '')),
                    ]); ?>"
                >
                    <?php echo e($slot); ?>

                </a>
            <?php elseif(filled($action)): ?>
                <?php
                    $wireClickAction = $action->getLivewireClickHandler();
                ?>

                <button
                    type="button"
                    wire:click="<?php echo e($wireClickAction); ?>"
                    wire:loading.attr="disabled"
                    wire:target="<?php echo e($wireClickAction); ?>"
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'fi-in-entry-content',
                        (($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : (is_string($alignment) ? $alignment : '')),
                    ]); ?>"
                >
                    <?php echo e($slot); ?>

                </button>
            <?php else: ?>
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'fi-in-entry-content',
                        (($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : (is_string($alignment) ? $alignment : '')),
                    ]); ?>"
                >
                    <?php echo e($slot); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo e($afterContentContainer); ?>

        </div>

        <?php echo e($entry?->getChildSchema($entry::BELOW_CONTENT_SCHEMA_KEY)); ?>

    </div>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/infolists/resources/views/components/entry-wrapper.blade.php ENDPATH**/ ?>