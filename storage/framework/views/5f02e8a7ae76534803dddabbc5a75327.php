<?php
    $isSidebarCollapsibleOnDesktop = filament()->isSidebarCollapsibleOnDesktop();
?>

<button class="fi-sidebar-database-notifications-btn">
    <?php echo e(\Filament\Support\generate_icon_html(\Filament\Support\Icons\Heroicon::OutlinedBell, alias: \Filament\View\PanelsIconAlias::SIDEBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON, size: \Filament\Support\Enums\IconSize::Large)); ?>


    <span
        <?php if($isSidebarCollapsibleOnDesktop): ?>
            x-show="$store.sidebar.isOpen"
            x-transition:enter="fi-transition-enter"
            x-transition:enter-start="fi-transition-enter-start"
            x-transition:enter-end="fi-transition-enter-end"
        <?php endif; ?>
        class="fi-sidebar-database-notifications-btn-label"
    >
        <?php echo e(__('filament-panels::layout.actions.open_database_notifications.label')); ?>

    </span>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadNotificationsCount): ?>
        <span
            <?php if($isSidebarCollapsibleOnDesktop): ?>
                x-show="$store.sidebar.isOpen"
                x-transition:enter="fi-transition-enter"
                x-transition:enter-start="fi-transition-enter-start"
                x-transition:enter-end="fi-transition-enter-end"
            <?php endif; ?>
            class="fi-sidebar-database-notifications-btn-badge-ctn"
        >
            <?php if (isset($component)) { $__componentOriginal986dce9114ddce94a270ab00ce6c273d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal986dce9114ddce94a270ab00ce6c273d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.badge','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php echo e($unreadNotificationsCount); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $attributes = $__attributesOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__attributesOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal986dce9114ddce94a270ab00ce6c273d)): ?>
<?php $component = $__componentOriginal986dce9114ddce94a270ab00ce6c273d; ?>
<?php unset($__componentOriginal986dce9114ddce94a270ab00ce6c273d); ?>
<?php endif; ?>
        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</button>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/sidebar/database-notifications-trigger.blade.php ENDPATH**/ ?>