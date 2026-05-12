<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'actions' => false,
    'actionsPosition' => null,
    'allTableSummary' => true,
    'columns',
    'extraHeadingColumn' => false,
    'groupColumn' => null,
    'groupsOnly' => false,
    'pageSummary' => true,
    'placeholderColumns' => true,
    'pluralModelLabel',
    'recordCheckboxPosition' => null,
    'records',
    'selectionEnabled' => false,
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
    'actions' => false,
    'actionsPosition' => null,
    'allTableSummary' => true,
    'columns',
    'extraHeadingColumn' => false,
    'groupColumn' => null,
    'groupsOnly' => false,
    'pageSummary' => true,
    'placeholderColumns' => true,
    'pluralModelLabel',
    'recordCheckboxPosition' => null,
    'records',
    'selectionEnabled' => false,
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
    use Filament\Tables\Columns\Column;
    use Filament\Tables\Enums\RecordActionsPosition;
    use Filament\Tables\Enums\RecordCheckboxPosition;

    if ($groupsOnly && $groupColumn) {
        $columns = collect($columns)
            ->reject(fn (Column $column): bool => $column->getName() === $groupColumn)
            ->all();
    }

    $hasPageSummary = $pageSummary && (! $groupsOnly) && $records instanceof \Illuminate\Contracts\Pagination\Paginator && $records->hasPages();

    $pageTableSummaryQuery = $hasPageSummary ? $this->getPageTableSummaryQuery() : null;
    $allTableSummaryQuery = $allTableSummary ? $this->getAllTableSummaryQuery() : null;
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPageSummary): ?>
    <tr class="fi-ta-row fi-ta-summary-header-row fi-striped">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderColumns && $actions && in_array($actionsPosition, [RecordActionsPosition::BeforeCells, RecordActionsPosition::BeforeColumns])): ?>
            <td></td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderColumns && $selectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::BeforeCells): ?>
            <td></td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($extraHeadingColumn): ?>
            <td class="fi-ta-cell fi-ta-summary-header-cell">
                <?php echo e(__('filament-tables::table.summary.heading', ['label' => $pluralModelLabel])); ?>

            </td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $columnHasSummary = ($pageTableSummaryQuery && $column->hasSummary($pageTableSummaryQuery)) || $column->hasSummary($allTableSummaryQuery);
            ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderColumns || $columnHasSummary): ?>
                <?php
                    $alignment = $column->getAlignment() ?? Alignment::Start;

                    if (! $alignment instanceof Alignment) {
                        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
                    }

                    $hasColumnHeaderLabel = (! $placeholderColumns) || $columnHasSummary;
                ?>

                <td
                    <?php echo e($column->getExtraHeaderAttributeBag()->class([
                            'fi-ta-cell fi-ta-summary-header-cell',
                            'fi-wrapped' => $column->canHeaderWrap(),
                            (($alignment instanceof Alignment) ? "fi-align-{$alignment->value}" : (is_string($alignment) ? $alignment : '')) => (! ($loop->first && (! $extraHeadingColumn))) && $hasColumnHeaderLabel,
                        ])); ?>

                >
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->first && (! $extraHeadingColumn)): ?>
                        <?php echo e(__('filament-tables::table.summary.heading', ['label' => $pluralModelLabel])); ?>

                    <?php elseif($hasColumnHeaderLabel): ?>
                        <?php echo e($column->getLabel()); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </td>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderColumns && $actions && in_array($actionsPosition, [RecordActionsPosition::AfterColumns, RecordActionsPosition::AfterCells])): ?>
            <td></td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholderColumns && $selectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::AfterCells): ?>
            <td></td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tr>

    <?php
        $selectedState = $this->getTableSummarySelectedState($pageTableSummaryQuery)[0] ?? [];
    ?>

    <?php if (isset($component)) { $__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['actions' => $actions,'actionsPosition' => $actionsPosition,'columns' => $columns,'extraHeadingColumn' => $extraHeadingColumn,'heading' => __('filament-tables::table.summary.subheadings.page', ['label' => $pluralModelLabel]),'placeholderColumns' => $placeholderColumns,'query' => $pageTableSummaryQuery,'recordCheckboxPosition' => $recordCheckboxPosition,'selectedState' => $selectedState,'selectionEnabled' => $selectionEnabled]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'extra-heading-column' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($extraHeadingColumn),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.summary.subheadings.page', ['label' => $pluralModelLabel])),'placeholder-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($placeholderColumns),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageTableSummaryQuery),'record-checkbox-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordCheckboxPosition),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedState),'selection-enabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectionEnabled)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb)): ?>
<?php $attributes = $__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb; ?>
<?php unset($__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb)): ?>
<?php $component = $__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb; ?>
<?php unset($__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allTableSummary): ?>
    <?php
        $selectedState = $this->getTableSummarySelectedState($allTableSummaryQuery)[0] ?? [];
    ?>

    <?php if (isset($component)) { $__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['actions' => $actions,'actionsPosition' => $actionsPosition,'columns' => $columns,'extraHeadingColumn' => $extraHeadingColumn,'groupsOnly' => $groupsOnly,'heading' => __(($hasPageSummary ? 'filament-tables::table.summary.subheadings.all' : 'filament-tables::table.summary.heading'), ['label' => $pluralModelLabel]),'placeholderColumns' => $placeholderColumns,'query' => $allTableSummaryQuery,'recordCheckboxPosition' => $recordCheckboxPosition,'selectedState' => $selectedState,'selectionEnabled' => $selectionEnabled,'class' => \Illuminate\Support\Arr::toCssClasses([
            'fi-striped' => ! $hasPageSummary,
        ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'extra-heading-column' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($extraHeadingColumn),'groups-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupsOnly),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__(($hasPageSummary ? 'filament-tables::table.summary.subheadings.all' : 'filament-tables::table.summary.heading'), ['label' => $pluralModelLabel])),'placeholder-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($placeholderColumns),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allTableSummaryQuery),'record-checkbox-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordCheckboxPosition),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedState),'selection-enabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectionEnabled),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
            'fi-striped' => ! $hasPageSummary,
        ]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb)): ?>
<?php $attributes = $__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb; ?>
<?php unset($__attributesOriginala3ad14087ab6b316cf1e1d1a634acbeb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb)): ?>
<?php $component = $__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb; ?>
<?php unset($__componentOriginala3ad14087ab6b316cf1e1d1a634acbeb); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/tables/resources/views/components/summary/index.blade.php ENDPATH**/ ?>