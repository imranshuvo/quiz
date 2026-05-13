<div class="mx-auto w-full max-w-5xl p-6 space-y-6">
    @include('livewire.questionnaires.partials.subnav', ['questionnaire' => $questionnaire, 'active' => 'webhooks'])

    <div class="flex items-center justify-between gap-3">
        <div>
            <flux:heading size="md">Webhooks</flux:heading>
            <flux:subheading>Get a signed POST every time someone submits a response.</flux:subheading>
        </div>
        <flux:button size="sm" variant="primary" icon="plus" wire:click="openCreate">Add endpoint</flux:button>
    </div>

    @if ($endpoints->isEmpty())
        <flux:callout icon="bolt" color="zinc">
            No endpoints yet. Add one above and we'll POST a JSON payload (HMAC-SHA256 signed in the
            <code>X-Signature-256</code> header) on every submitted response.
        </flux:callout>
    @else
        <div class="space-y-3">
            @foreach ($endpoints as $endpoint)
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4 space-y-3">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div class="min-w-0 flex-1 space-y-1">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold">{{ $endpoint->name }}</p>
                                <flux:badge size="sm" :color="$endpoint->active ? 'lime' : 'zinc'">
                                    {{ $endpoint->active ? 'Active' : 'Paused' }}
                                </flux:badge>
                            </div>
                            <p class="font-mono text-xs text-zinc-500 break-all">{{ $endpoint->url }}</p>
                            <p class="text-xs text-zinc-500">
                                {{ $endpoint->success_count }} / {{ $endpoint->deliveries_count }} successful ·
                                @if ($endpoint->last_delivered_at)
                                    last delivered {{ $endpoint->last_delivered_at->diffForHumans() }}
                                @else
                                    never delivered
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <flux:button size="xs" variant="ghost" icon="{{ $endpoint->active ? 'pause' : 'play' }}" wire:click="toggle({{ $endpoint->id }})">
                                {{ $endpoint->active ? 'Pause' : 'Resume' }}
                            </flux:button>
                            <flux:button size="xs" variant="danger" icon="trash" wire:click="delete({{ $endpoint->id }})" wire:confirm="Delete this webhook endpoint?">Delete</flux:button>
                        </div>
                    </div>
                    <details class="text-xs text-zinc-500">
                        <summary class="cursor-pointer select-none hover:text-zinc-700 dark:hover:text-zinc-300">
                            Show signing secret
                        </summary>
                        <p class="mt-2 font-mono break-all rounded bg-zinc-50 dark:bg-zinc-900 px-3 py-2">{{ $endpoint->secret }}</p>
                        <p class="mt-1">
                            Verify: <code>X-Signature-256: sha256=&lt;hmac_sha256(body, secret)&gt;</code>
                        </p>
                    </details>
                </div>
            @endforeach
        </div>
    @endif

    <flux:modal wire:model.self="showCreate" name="add-webhook">
        <div class="space-y-6">
            <flux:heading size="lg">New webhook endpoint</flux:heading>
            <flux:input wire:model="newName" label="Name" placeholder="Slack #responses" autofocus />
            <flux:input wire:model="newUrl" label="URL" type="url" placeholder="https://example.com/webhooks/quiz" />
            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" x-on:click="$wire.showCreate = false">Cancel</flux:button>
                <flux:button variant="primary" wire:click="create">Add endpoint</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
