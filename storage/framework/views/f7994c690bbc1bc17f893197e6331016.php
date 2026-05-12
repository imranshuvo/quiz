<?php
    $id = $getId();
    $key = $getKey(isAbsolute: false);
    $tabs = $getContainer()->getParentComponent();
    $isContained = $tabs->isContained();
    $livewireProperty = $tabs->getLivewireProperty();

    $childSchema = $getChildSchema();
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($childSchema->getComponents())): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(blank($livewireProperty)): ?>
        <div
            x-bind:class="{
                'fi-active': tab === <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>,
            }"
            x-on:expand="tab = <?php echo \Illuminate\Support\Js::from($key)->toHtml() ?>"
            <?php echo e($attributes
                    ->merge([
                        'aria-labelledby' => $id,
                        'id' => $id,
                        'role' => 'tabpanel',
                        'wire:key' => $getLivewireKey() . '.container',
                    ], escape: false)
                    ->merge($getExtraAttributes(), escape: false)
                    ->class(['fi-sc-tabs-tab'])); ?>

        >
            <?php echo e($childSchema); ?>

        </div>
    <?php elseif(strval($this->{$livewireProperty}) === strval($key)): ?>
        <div
            <?php echo e($attributes
                    ->merge([
                        'aria-labelledby' => $id,
                        'id' => $id,
                        'role' => 'tabpanel',
                        'wire:key' => $getLivewireKey() . '.container',
                    ], escape: false)
                    ->merge($getExtraAttributes(), escape: false)
                    ->class(['fi-sc-tabs-tab fi-active'])); ?>

        >
            <?php echo e($childSchema); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/schemas/resources/views/components/tabs/tab.blade.php ENDPATH**/ ?>