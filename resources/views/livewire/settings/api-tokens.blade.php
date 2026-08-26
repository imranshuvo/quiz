<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('API tokens')" :subheading="__('Create scoped tokens for integrations using the JSON API.')">
        <div class="space-y-6">
            @if ($plainTextToken)
                <div role="status" aria-live="polite" class="rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-emerald-950 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-100">
                    <p class="font-medium">Copy this token now. It will not be shown again.</p>
                    <div class="mt-3 flex items-start gap-2">
                        <code class="min-w-0 flex-1 break-all rounded bg-white/70 p-2 text-xs dark:bg-black/20">{{ $plainTextToken }}</code>
                        <flux:button size="sm" variant="ghost" x-on:click="navigator.clipboard.writeText(@js($plainTextToken))">Copy</flux:button>
                    </div>
                    <flux:button class="mt-3" size="sm" variant="ghost" wire:click="dismissToken">I saved it</flux:button>
                </div>
            @endif

            <form wire:submit="createToken" class="space-y-4">
                <flux:input wire:model="tokenName" label="Token name" placeholder="Reporting integration" autocomplete="off" />

                @if ($canWrite)
                    <flux:checkbox wire:model="writeAccess" label="Allow creating and editing questionnaire content" />
                @endif

                <flux:button type="submit" variant="primary" icon="key">Create token</flux:button>
            </form>

            <flux:separator />

            <div>
                <flux:heading size="sm">Active tokens</flux:heading>
                @if ($tokens->isEmpty())
                    <flux:text class="mt-2 text-zinc-500">No API tokens yet.</flux:text>
                @else
                    <div class="mt-3 space-y-2">
                        @foreach ($tokens as $token)
                            <div class="flex items-center justify-between gap-3 rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-medium">{{ $token->name }}</p>
                                    <p class="text-xs text-zinc-500">
                                        {{ in_array('content:write', $token->abilities ?? [], true) ? 'Read and write' : 'Read only' }}
                                        · Last used {{ $token->last_used_at?->diffForHumans() ?? 'never' }}
                                        · Expires {{ $token->expires_at?->toFormattedDateString() ?? 'never' }}
                                    </p>
                                </div>
                                <flux:button size="xs" variant="danger" icon="trash" wire:click="revokeToken({{ $token->id }})" wire:confirm="Revoke '{{ $token->name }}'?">Revoke</flux:button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <flux:callout icon="information-circle" color="zinc">
                Send the token as <code>Authorization: Bearer …</code>. Use the <code>X-Workspace</code> header with a workspace slug when you belong to more than one workspace.
            </flux:callout>
        </div>
    </x-settings.layout>
</section>
