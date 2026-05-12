<?php
    use Filament\Support\Enums\IconPosition;
    use Filament\Widgets\View\Components\StatsOverviewWidgetComponent\StatComponent\DescriptionComponent;
    use Filament\Widgets\View\Components\StatsOverviewWidgetComponent\StatComponent\StatsOverviewWidgetStatChartComponent;
    use Illuminate\View\ComponentAttributeBag;

    $chartColor = $getChartColor() ?? 'gray';
    $descriptionColor = $getDescriptionColor() ?? 'gray';
    $descriptionIcon = $getDescriptionIcon();
    $descriptionIconPosition = $getDescriptionIconPosition();
    $url = $getUrl();
    $tag = $url ? 'a' : 'div';
    $chartDataChecksum = $generateChartDataChecksum();
?>

<<?php echo $tag; ?>

    <?php if($url): ?>
        <?php echo e(\Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab())); ?>

    <?php endif; ?>
    <?php echo e($getExtraAttributeBag()
            ->class([
                'fi-wi-stats-overview-stat',
            ])); ?>

>
    <div class="fi-wi-stats-overview-stat-content">
        <div class="fi-wi-stats-overview-stat-label-ctn">
            <?php echo e(\Filament\Support\generate_icon_html($getIcon())); ?>


            <span class="fi-wi-stats-overview-stat-label">
                <?php echo e($getLabel()); ?>

            </span>
        </div>

        <div class="fi-wi-stats-overview-stat-value">
            <?php echo e($getValue()); ?>

        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description = $getDescription()): ?>
            <div
                <?php echo e((new ComponentAttributeBag)->color(DescriptionComponent::class, $descriptionColor)->class(['fi-wi-stats-overview-stat-description'])); ?>

            >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::Before, 'before'])): ?>
                    <?php echo e(\Filament\Support\generate_icon_html($descriptionIcon, attributes: (new \Illuminate\View\ComponentAttributeBag))); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <span>
                    <?php echo e($description); ?>

                </span>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::After, 'after'])): ?>
                    <?php echo e(\Filament\Support\generate_icon_html($descriptionIcon, attributes: (new \Illuminate\View\ComponentAttributeBag))); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($chart = $getChart()): ?>
        
        <div x-data="{ statsOverviewStatChart() {} }">
            <div
                x-load
                x-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('stats-overview/stat/chart', 'filament/widgets')); ?>"
                x-data="statsOverviewStatChart({
                            dataChecksum: <?php echo \Illuminate\Support\Js::from($chartDataChecksum)->toHtml() ?>,
                            labels: <?php echo \Illuminate\Support\Js::from(array_keys($chart))->toHtml() ?>,
                            values: <?php echo \Illuminate\Support\Js::from(array_values($chart))->toHtml() ?>,
                        })"
                <?php echo e((new ComponentAttributeBag)->color(StatsOverviewWidgetStatChartComponent::class, $chartColor)->class(['fi-wi-stats-overview-stat-chart'])); ?>

            >
                <canvas x-ref="canvas"></canvas>

                <span
                    x-ref="backgroundColorElement"
                    class="fi-wi-stats-overview-stat-chart-bg-color"
                ></span>

                <span
                    x-ref="borderColorElement"
                    class="fi-wi-stats-overview-stat-chart-border-color"
                ></span>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</<?php echo $tag; ?>>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/widgets/resources/views/stats-overview-widget/stat.blade.php ENDPATH**/ ?>