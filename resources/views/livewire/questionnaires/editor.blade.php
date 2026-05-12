<div class="mx-auto w-full max-w-4xl p-6 space-y-8">
    <div class="flex items-start justify-between gap-4">
        <div class="flex-1 space-y-3">
            <flux:input wire:model.blur="title" wire:change="saveDetails" label="Title" />
            <flux:textarea wire:model.blur="description" wire:change="saveDetails" label="Description" rows="2" />
        </div>
        <div class="flex flex-col items-end gap-2 pt-6">
            <flux:badge :color="$questionnaire->status->value === 'published' ? 'lime' : 'zinc'">
                {{ $questionnaire->status->label() }} · {{ $questionnaire->kind->label() }}
            </flux:badge>
            @if ($questionnaire->status->value !== 'published')
                <flux:button size="sm" variant="primary" icon="rocket-launch" wire:click="publish">Publish</flux:button>
            @else
                <flux:button size="sm" variant="ghost" icon="archive-box" wire:click="archive">Archive</flux:button>
            @endif
            @error('publish') <flux:text size="sm" class="text-red-600">{{ $message }}</flux:text> @enderror
        </div>
    </div>

    <flux:separator />

    <div class="space-y-6">
        <flux:heading size="md">Questions</flux:heading>

        @forelse ($questions as $q)
            <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 space-y-3" wire:key="q-{{ $q->id }}">
                <div class="flex items-center justify-between">
                    <flux:badge size="sm" variant="subtle">#{{ $q->position }} · {{ $q->type->label() }}</flux:badge>
                    <div class="flex items-center gap-2">
                        <flux:checkbox
                            label="Required"
                            :checked="$q->required"
                            wire:change="updateQuestion({{ $q->id }}, 'required', $event.target.checked)"
                        />
                        <flux:button size="xs" variant="danger" icon="trash"
                            wire:click="deleteQuestion({{ $q->id }})"
                            wire:confirm="Delete this question?"
                        >Delete</flux:button>
                    </div>
                </div>

                <flux:input
                    label="Question"
                    :value="$q->title"
                    wire:change="updateQuestion({{ $q->id }}, 'title', $event.target.value)"
                />
                <flux:input
                    label="Helper text"
                    :value="$q->helper"
                    wire:change="updateQuestion({{ $q->id }}, 'helper', $event.target.value)"
                />

                @if ($q->type->hasOptions())
                    <div class="space-y-2">
                        <flux:heading size="sm">Options</flux:heading>
                        @foreach ($q->options as $opt)
                            <div class="flex items-center gap-2" wire:key="opt-{{ $opt->id }}">
                                <flux:input
                                    placeholder="Label"
                                    :value="$opt->label"
                                    wire:change="updateOption({{ $opt->id }}, 'label', $event.target.value)"
                                    class="flex-1"
                                />
                                <flux:input
                                    placeholder="Stored value"
                                    :value="$opt->value"
                                    wire:change="updateOption({{ $opt->id }}, 'value', $event.target.value)"
                                    class="w-40"
                                />
                                @if ($questionnaire->kind->isGraded() && $q->type->isAutoGradable())
                                    <flux:checkbox
                                        label="Correct"
                                        :checked="$opt->is_correct"
                                        wire:change="updateOption({{ $opt->id }}, 'is_correct', $event.target.checked)"
                                    />
                                    <flux:input
                                        type="number"
                                        step="0.5"
                                        placeholder="Pts"
                                        :value="$opt->score"
                                        wire:change="updateOption({{ $opt->id }}, 'score', $event.target.value)"
                                        class="w-20"
                                    />
                                @endif
                                <flux:button size="xs" variant="ghost" icon="x-mark"
                                    wire:click="deleteOption({{ $opt->id }})"
                                />
                            </div>
                        @endforeach
                        <flux:button size="xs" variant="ghost" icon="plus" wire:click="addOption({{ $q->id }})">
                            Add option
                        </flux:button>
                    </div>
                @endif
            </div>
        @empty
            <flux:callout icon="question-mark-circle" color="zinc">
                No questions yet. Pick a type below to add the first one.
            </flux:callout>
        @endforelse

        <div class="flex flex-wrap gap-2 pt-2">
            @foreach ($questionTypes as $type)
                <flux:button size="sm" variant="ghost" icon="plus" wire:click="addQuestion('{{ $type->value }}')">
                    {{ $type->label() }}
                </flux:button>
            @endforeach
        </div>
    </div>
</div>
