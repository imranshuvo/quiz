<?php if (isset($component)) { $__componentOriginalf0029cce6d19fd6d472097ff06a800a1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['badge' => $unreadNotificationsCount ?: null,'color' => 'gray','icon' => \Filament\Support\Icons\Heroicon::OutlinedBell,'iconAlias' => \Filament\View\PanelsIconAlias::TOPBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON,'iconSize' => 'lg','label' => __('filament-panels::layout.actions.open_database_notifications.label'),'class' => 'fi-topbar-database-notifications-btn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['badge' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unreadNotificationsCount ?: null),'color' => 'gray','icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::OutlinedBell),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\View\PanelsIconAlias::TOPBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON),'icon-size' => 'lg','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-panels::layout.actions.open_database_notifications.label')),'class' => 'fi-topbar-database-notifications-btn']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $attributes = $__attributesOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__attributesOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1)): ?>
<?php $component = $__componentOriginalf0029cce6d19fd6d472097ff06a800a1; ?>
<?php unset($__componentOriginalf0029cce6d19fd6d472097ff06a800a1); ?>
<?php endif; ?>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/topbar/database-notifications-trigger.blade.php ENDPATH**/ ?>