<?php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\View\Components\BadgeComponent;
    use Illuminate\View\ComponentAttributeBag;

    $notifications = $this->getNotifications();
    $unreadNotificationsCount = $this->getUnreadNotificationsCount();
    $hasNotifications = $notifications->count();
    $isPaginated = $notifications instanceof \Illuminate\Contracts\Pagination\Paginator && $notifications->hasPages();
    $pollingInterval = $this->getPollingInterval();
?>

<div class="fi-no-database">
    <?php if (isset($component)) { $__componentOriginal0942a211c37469064369f887ae8d1cef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0942a211c37469064369f887ae8d1cef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $hasNotifications ? null : Alignment::Center,'closeButton' => true,'description' => $hasNotifications ? null : __('filament-notifications::database.modal.empty.description'),'heading' => $hasNotifications ? null : __('filament-notifications::database.modal.empty.heading'),'icon' => $hasNotifications ? null : \Filament\Support\Icons\Heroicon::OutlinedBellSlash,'iconAlias' => 
            $hasNotifications
            ? null
            : \Filament\Notifications\View\NotificationsIconAlias::DATABASE_MODAL_EMPTY_STATE
        ,'iconColor' => $hasNotifications ? null : 'gray','id' => 'database-notifications','slideOver' => true,'stickyHeader' => $hasNotifications,'teleport' => 'body','width' => 'md','class' => 'fi-no-database','attributes' => 
            new \Illuminate\View\ComponentAttributeBag([
                'wire:poll.' . $pollingInterval => $pollingInterval ? '' : false,
            ])
        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications ? null : Alignment::Center),'close-button' => true,'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications ? null : __('filament-notifications::database.modal.empty.description')),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications ? null : __('filament-notifications::database.modal.empty.heading')),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications ? null : \Filament\Support\Icons\Heroicon::OutlinedBellSlash),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            $hasNotifications
            ? null
            : \Filament\Notifications\View\NotificationsIconAlias::DATABASE_MODAL_EMPTY_STATE
        ),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications ? null : 'gray'),'id' => 'database-notifications','slide-over' => true,'sticky-header' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($hasNotifications),'teleport' => 'body','width' => 'md','class' => 'fi-no-database','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            new \Illuminate\View\ComponentAttributeBag([
                'wire:poll.' . $pollingInterval => $pollingInterval ? '' : false,
            ])
        )]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trigger = $this->getTrigger()): ?>
             <?php $__env->slot('trigger', null, []); ?> 
                <?php echo e($trigger->with(['unreadNotificationsCount' => $unreadNotificationsCount])); ?>

             <?php $__env->endSlot(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasNotifications): ?>
             <?php $__env->slot('header', null, []); ?> 
                <div>
                    <h2 class="fi-modal-heading">
                        <?php echo e(__('filament-notifications::database.modal.heading')); ?>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadNotificationsCount): ?>
                            <span
                                <?php echo e((new ComponentAttributeBag)->color(BadgeComponent::class, 'primary')->class([
                                        'fi-badge fi-size-xs',
                                    ])); ?>

                            >
                                <?php echo e($unreadNotificationsCount); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </h2>

                    <div class="fi-ac">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadNotificationsCount && $this->markAllNotificationsAsReadAction?->isVisible()): ?>
                            <?php echo e($this->markAllNotificationsAsReadAction); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->clearNotificationsAction?->isVisible()): ?>
                            <?php echo e($this->clearNotificationsAction); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
             <?php $__env->endSlot(); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'fi-no-notification-read-ctn' => ! $notification->unread(),
                        'fi-no-notification-unread-ctn' => $notification->unread(),
                    ]); ?>"
                >
                    <?php echo e($this->getNotification($notification)->inline()); ?>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($broadcastChannel = $this->getBroadcastChannel()): ?>
                    <?php
        $__scriptKey = '1183206691-0';
        ob_start();
    ?>
                    <script>
                        window.addEventListener('EchoLoaded', () => {
                            window.Echo.private(<?php echo \Illuminate\Support\Js::from($broadcastChannel)->toHtml() ?>).listen(
                                '.database-notifications.sent',
                                () => {
                                    setTimeout(
                                        () => $wire.call('$refresh'),
                                        500,
                                    )
                                },
                            )
                        })

                        if (window.Echo) {
                            window.dispatchEvent(new CustomEvent('EchoLoaded'))
                        }
                    </script>
                    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isPaginated): ?>
                 <?php $__env->slot('footer', null, []); ?> 
                    <?php if (isset($component)) { $__componentOriginal0c287a00f29f01c8f977078ff96faed4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0c287a00f29f01c8f977078ff96faed4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.index','data' => ['paginator' => $notifications]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['paginator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($notifications)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0c287a00f29f01c8f977078ff96faed4)): ?>
<?php $attributes = $__attributesOriginal0c287a00f29f01c8f977078ff96faed4; ?>
<?php unset($__attributesOriginal0c287a00f29f01c8f977078ff96faed4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0c287a00f29f01c8f977078ff96faed4)): ?>
<?php $component = $__componentOriginal0c287a00f29f01c8f977078ff96faed4; ?>
<?php unset($__componentOriginal0c287a00f29f01c8f977078ff96faed4); ?>
<?php endif; ?>
                 <?php $__env->endSlot(); ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0942a211c37469064369f887ae8d1cef)): ?>
<?php $attributes = $__attributesOriginal0942a211c37469064369f887ae8d1cef; ?>
<?php unset($__attributesOriginal0942a211c37469064369f887ae8d1cef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0942a211c37469064369f887ae8d1cef)): ?>
<?php $component = $__componentOriginal0942a211c37469064369f887ae8d1cef; ?>
<?php unset($__componentOriginal0942a211c37469064369f887ae8d1cef); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/notifications/resources/views/database-notifications.blade.php ENDPATH**/ ?>