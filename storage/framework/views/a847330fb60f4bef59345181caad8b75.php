<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'buttonGroup' => null,
    'color' => null,
    'dropdownMaxHeight' => null,
    'dropdownOffset' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'group' => null,
    'icon' => null,
    'iconSize' => null,
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'triggerView' => null,
    'view' => null,
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
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'buttonGroup' => null,
    'color' => null,
    'dropdownMaxHeight' => null,
    'dropdownOffset' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'group' => null,
    'icon' => null,
    'iconSize' => null,
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'triggerView' => null,
    'view' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $group ??= \Filament\Actions\ActionGroup::make($actions)
        ->badgeColor($badgeColor)
        ->color($color)
        ->dropdownMaxHeight($dropdownMaxHeight)
        ->dropdownOffset($dropdownOffset)
        ->dropdownPlacement($dropdownPlacement)
        ->dropdownWidth($dropdownWidth)
        ->icon($icon)
        ->iconSize($iconSize)
        ->label($label)
        ->size($size)
        ->tooltip($tooltip)
        ->triggerView($triggerView)
        ->view($view);

    $badge === true
        ? $group->badge()
        : $group->badge($badge);

    if ($button) {
        $group
            ->button()
            ->iconPosition($attributes->get('iconPosition') ?? $attributes->get('icon-position'))
            ->outlined($attributes->get('outlined') ?? false);
    }

    if ($buttonGroup) {
        $group->buttonGroup();
    }

    if ($iconButton) {
        $group->iconButton();
    }

    if ($link) {
        $group->link();
    }
?>

<?php echo e($group); ?>

<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/actions/resources/views/components/group.blade.php ENDPATH**/ ?>