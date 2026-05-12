<div
    x-data="{ theme: null }"
    x-init="
        $watch('theme', () => {
            $dispatch('theme-changed', theme)
        })

        theme = localStorage.getItem('theme') || <?php echo \Illuminate\Support\Js::from(filament()->getDefaultThemeMode()->value)->toHtml() ?>
    "
    class="fi-theme-switcher"
>
    <?php if (isset($component)) { $__componentOriginalad1f400c934be44fb66b397d4f7989b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalad1f400c934be44fb66b397d4f7989b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.theme-switcher.button','data' => ['icon' => \Filament\Support\Icons\Heroicon::Sun,'theme' => 'light']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::theme-switcher.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::Sun),'theme' => 'light']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $attributes = $__attributesOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $component = $__componentOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__componentOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalad1f400c934be44fb66b397d4f7989b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalad1f400c934be44fb66b397d4f7989b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.theme-switcher.button','data' => ['icon' => \Filament\Support\Icons\Heroicon::Moon,'theme' => 'dark']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::theme-switcher.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::Moon),'theme' => 'dark']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $attributes = $__attributesOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $component = $__componentOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__componentOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalad1f400c934be44fb66b397d4f7989b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalad1f400c934be44fb66b397d4f7989b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.theme-switcher.button','data' => ['icon' => \Filament\Support\Icons\Heroicon::ComputerDesktop,'theme' => 'system']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::theme-switcher.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\Icons\Heroicon::ComputerDesktop),'theme' => 'system']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $attributes = $__attributesOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__attributesOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalad1f400c934be44fb66b397d4f7989b8)): ?>
<?php $component = $__componentOriginalad1f400c934be44fb66b397d4f7989b8; ?>
<?php unset($__componentOriginalad1f400c934be44fb66b397d4f7989b8); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/imrankhan/Sites/quiz/vendor/filament/filament/resources/views/components/theme-switcher/index.blade.php ENDPATH**/ ?>