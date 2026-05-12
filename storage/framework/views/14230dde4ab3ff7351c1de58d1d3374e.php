<?php
    use Filament\Actions\View\ActionsRenderHook;
    use Filament\Support\Facades\FilamentView;

    $actionModalAlignment = $action->getModalAlignment();
    $actionIsModalAutofocused = $action->isModalAutofocused();
    $actionHasModalCloseButton = $action->hasModalCloseButton();
    $actionIsModalClosedByClickingAway = $action->isModalClosedByClickingAway();
    $actionIsModalClosedByEscaping = $action->isModalClosedByEscaping();
    $actionModalDescription = $action->getModalDescription();
    $actionExtraModalWindowAttributeBag = $action->getExtraModalWindowAttributeBag();
    $actionExtraModalOverlayAttributeBag = $action->getExtraModalOverlayAttributeBag();
    $actionModalFooterActions = $action->getVisibleModalFooterActions();
    $actionModalFooterActionsAlignment = $action->getModalFooterActionsAlignment();
    $actionModalHeading = $action->getModalHeading();
    $actionModalIcon = $action->getModalIcon();
    $actionModalIconColor = $action->getModalIconColor();
    $actionModalId = "fi-{$this->getId()}-action-{$action->getNestingIndex()}";
    $actionIsModalSlideOver = $action->isModalSlideOver();
    $actionModalSlideOverPosition = $action->getModalSlideOverPosition();
    $actionIsModalFooterSticky = $action->isModalFooterSticky();
    $actionIsModalHeaderSticky = $action->isModalHeaderSticky();
    $actionModalWidth = $action->getModalWidth();
    $actionLivewireCallMountedActionName = $action->hasFormWrapper() ? $action->getLivewireCallMountedActionName() : null;
    $actionModalWireKey = "{$this->getId()}.actions.{$action->getName()}.modal";
?>

<?php if (isset($component)) { $__componentOriginal0942a211c37469064369f887ae8d1cef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0942a211c37469064369f887ae8d1cef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $actionModalAlignment,'autofocus' => $actionIsModalAutofocused,'closeButton' => $actionHasModalCloseButton,'closeByClickingAway' => $actionIsModalClosedByClickingAway,'closeByEscaping' => $actionIsModalClosedByEscaping,'description' => $actionModalDescription,'extraModalWindowAttributeBag' => $actionExtraModalWindowAttributeBag,'extraModalOverlayAttributeBag' => $actionExtraModalOverlayAttributeBag,'footerActions' => $actionModalFooterActions,'footerActionsAlignment' => $actionModalFooterActionsAlignment,'heading' => $actionModalHeading,'icon' => $actionModalIcon,'iconColor' => $actionModalIconColor,'id' => $actionModalId,'slideOver' => $actionIsModalSlideOver,'slideOverPosition' => $actionModalSlideOverPosition,'stickyFooter' => $actionIsModalFooterSticky,'stickyHeader' => $actionIsModalHeaderSticky,'width' => $actionModalWidth,'wire:key' => $actionModalWireKey,'wire:submit.prevent' => $actionLivewireCallMountedActionName,'xOn:modalClosed' => 'if ($event.detail.id === ' . \Illuminate\Support\Js::from($actionModalId) . ') $wire.unmountAction(false)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalAlignment),'autofocus' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalAutofocused),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionHasModalCloseButton),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalClosedByClickingAway),'close-by-escaping' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalClosedByEscaping),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalDescription),'extra-modal-window-attribute-bag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionExtraModalWindowAttributeBag),'extra-modal-overlay-attribute-bag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionExtraModalOverlayAttributeBag),'footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalFooterActions),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalFooterActionsAlignment),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalHeading),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalIcon),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalIconColor),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalId),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalSlideOver),'slide-over-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalSlideOverPosition),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalFooterSticky),'sticky-header' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionIsModalHeaderSticky),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalWidth),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionModalWireKey),'wire:submit.prevent' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionLivewireCallMountedActionName),'x-on:modal-closed' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('if ($event.detail.id === ' . \Illuminate\Support\Js::from($actionModalId) . ') $wire.unmountAction(false)')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_CUSTOM_CONTENT_BEFORE, scopes: static::class, data: ['action' => $action])); ?>


    <?php echo e($action->getModalContent()); ?>


    <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_CUSTOM_CONTENT_AFTER, scopes: static::class, data: ['action' => $action])); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->mountedActionHasSchema(mountedAction: $action)): ?>
        <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_SCHEMA_BEFORE, scopes: static::class, data: ['action' => $action])); ?>


        <?php echo e($this->getMountedActionSchema(mountedAction: $action)); ?>


        <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_SCHEMA_AFTER, scopes: static::class, data: ['action' => $action])); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_CUSTOM_CONTENT_FOOTER_BEFORE, scopes: static::class, data: ['action' => $action])); ?>


    <?php echo e($action->getModalContentFooter()); ?>


    <?php echo e(FilamentView::renderHook(ActionsRenderHook::MODAL_CUSTOM_CONTENT_FOOTER_AFTER, scopes: static::class, data: ['action' => $action])); ?>

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
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/actions/resources/views/action-modal.blade.php ENDPATH**/ ?>