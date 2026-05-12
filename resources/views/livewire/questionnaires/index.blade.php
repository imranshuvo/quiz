<div class="mx-auto w-full max-w-5xl p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Questionnaires</flux:heading>
            <flux:subheading>Quizzes, surveys, polls and forms in this workspace.</flux:subheading>
        </div>
        <flux:button variant="primary" icon="plus" wire:click="openCreate">New questionnaire</flux:button>
    </div>

    @if ($questionnaires->isEmpty())
        <flux:callout icon="inbox" color="zinc">
            Nothing here yet. Create your first questionnaire to get started.
        </flux:callout>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Kind</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Questions</flux:table.column>
                <flux:table.column>Created</flux:table.column>
                <flux:table.column class="text-right">Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($questionnaires as $q)
                    <flux:table.row :key="'q-'.$q->id">
                        <flux:table.cell>
                            <a href="{{ route('questionnaires.edit', $q) }}" wire:navigate class="font-medium hover:underline">
                                {{ $q->title }}
                            </a>
                        </flux:table.cell>
                        <flux:table.cell>{{ $q->kind->label() }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" :color="$q->status->value === 'published' ? 'lime' : 'zinc'">
                                {{ $q->status->label() }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $q->questions_count }}</flux:table.cell>
                        <flux:table.cell>{{ $q->created_at->diffForHumans() }}</flux:table.cell>
                        <flux:table.cell class="text-right">
                            <flux:button size="xs" variant="ghost" icon="pencil-square" :href="route('questionnaires.edit', $q)" wire:navigate>Edit</flux:button>
                            <flux:button
                                size="xs"
                                variant="danger"
                                icon="trash"
                                wire:click="delete({{ $q->id }})"
                                wire:confirm="Delete '{{ $q->title }}'?"
                            >Delete</flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @endif

    <flux:modal wire:model.self="showCreate" name="create-questionnaire">
        <div class="space-y-6">
            <flux:heading size="lg">New questionnaire</flux:heading>

            <flux:input wire:model="newTitle" label="Title" placeholder="Customer feedback Q3" autofocus />

            <flux:select wire:model="newKind" label="Kind">
                @foreach ($kinds as $kind)
                    <flux:select.option value="{{ $kind->value }}">{{ $kind->label() }}</flux:select.option>
                @endforeach
            </flux:select>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" x-on:click="$wire.showCreate = false">Cancel</flux:button>
                <flux:button variant="primary" wire:click="create">Create</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
