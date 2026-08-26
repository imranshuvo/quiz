<div class="flex min-h-screen flex-col">
    {{-- Progress bar --}}
    <div class="sticky top-0 z-10 w-full bg-zinc-50/80 dark:bg-zinc-900/80 backdrop-blur border-b border-zinc-200/60 dark:border-zinc-800/60">
        <div class="mx-auto flex w-full max-w-3xl items-center gap-4 px-4 py-3">
            <div class="flex-1">
                <div class="h-1.5 w-full overflow-hidden rounded-full bg-zinc-200/80 dark:bg-zinc-800">
                    <div
                        role="progressbar"
                        aria-label="Questionnaire progress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        aria-valuenow="{{ $progress }}"
                        class="h-full rounded-full bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-pink-500 transition-[width] duration-500 ease-out"
                        style="width: {{ $progress }}%"
                    ></div>
                </div>
            </div>
            <div class="shrink-0 text-xs tabular-nums text-zinc-500 dark:text-zinc-400">
                {{ $position }} / {{ $total }}
            </div>
        </div>
    </div>

    {{-- Center stage --}}
    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col justify-center px-4 py-12 sm:py-20">
        @if (! $current)
            <div class="text-center space-y-4">
                <flux:heading size="xl">{{ $questionnaire->title }}</flux:heading>
                <flux:text>This questionnaire has no questions yet.</flux:text>
            </div>
        @else
            <div
                wire:key="question-{{ $current->id }}"
                x-data="{ show: false }"
                x-init="$nextTick(() => { show = true; $el.querySelector('h1')?.focus(); })"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="space-y-8"
            >
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        <span>Question {{ $position }}</span>
                        @if ($current->required)
                            <span class="text-pink-500">·  required</span>
                        @endif
                    </div>
                    <h1 tabindex="-1" class="text-2xl sm:text-3xl font-semibold leading-snug text-balance focus:outline-none">
                        {{ $current->title }}
                    </h1>
                    @if ($current->helper)
                        <p class="text-zinc-600 dark:text-zinc-400 text-base">{{ $current->helper }}</p>
                    @endif
                </div>

                <div>
                    @include('livewire.public.partials.input-'.$current->type->value, [
                        'q' => $current,
                        'value' => $answers[$current->id] ?? null,
                    ])
                </div>

                @error('answer') <flux:text role="alert" aria-live="assertive" class="text-pink-600">{{ $message }}</flux:text> @enderror

                <div class="flex items-center justify-between pt-4">
                    @if ($position > 1)
                        <flux:button variant="ghost" icon="arrow-left" wire:click="previous">Back</flux:button>
                    @else
                        <span></span>
                    @endif

                    <div class="flex items-center gap-3">
                        <span class="hidden sm:inline text-xs text-zinc-500">Press Enter ↵</span>
                        <flux:button
                            variant="primary"
                            icon-trailing="arrow-right"
                            wire:click="next"
                        >
                            {{ $position === $total ? 'Submit' : 'Next' }}
                        </flux:button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Footer --}}
    <footer class="mx-auto flex w-full max-w-3xl items-center justify-between px-4 py-6 text-xs text-zinc-500 dark:text-zinc-400">
        <span>{{ $questionnaire->title }}</span>
        <span>Powered by {{ config('app.name') }}</span>
    </footer>

    {{-- Global Enter-to-advance binding --}}
    <div
        x-data
        x-on:keydown.enter.window="if (!['TEXTAREA', 'BUTTON'].includes($event.target.tagName)) { $event.preventDefault(); $wire.next(); }"
        class="sr-only"
        aria-hidden="true"
    ></div>
</div>
