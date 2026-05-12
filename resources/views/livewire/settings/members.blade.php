<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Members')" :subheading="__('Invite teammates to '.($workspace?->name ?? 'this workspace').' and manage their roles.')">
        @if (session('status'))
            <flux:callout icon="check-circle" color="lime" class="mb-4">
                {{ session('status') }}
            </flux:callout>
        @endif

        @if ($authRole && $authRole->canManageMembers())
            <form wire:submit="sendInvitation" class="space-y-3">
                <div class="flex gap-2">
                    <flux:input
                        wire:model="inviteEmail"
                        type="email"
                        placeholder="teammate@example.com"
                        autocomplete="off"
                        class="flex-1"
                        :label="__('Invite by email')"
                    />
                    <flux:select wire:model="inviteRole" :label="__('Role')" class="w-40">
                        @foreach ($roleOptions as $role)
                            <flux:select.option value="{{ $role->value }}">{{ $role->label() }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <flux:button type="submit" variant="primary" icon="paper-airplane">
                    {{ __('Send invitation') }}
                </flux:button>
            </form>

            <flux:separator class="my-8" />
        @endif

        @if ($invitations->isNotEmpty())
            <flux:heading size="sm">{{ __('Pending invitations') }}</flux:heading>
            <flux:table class="mt-3">
                <flux:table.columns>
                    <flux:table.column>Email</flux:table.column>
                    <flux:table.column>Role</flux:table.column>
                    <flux:table.column>Expires</flux:table.column>
                    <flux:table.column class="text-right">Actions</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($invitations as $invitation)
                        <flux:table.row :key="'inv-'.$invitation->id">
                            <flux:table.cell>{{ $invitation->email }}</flux:table.cell>
                            <flux:table.cell>{{ $invitation->role->label() }}</flux:table.cell>
                            <flux:table.cell>{{ $invitation->expires_at->diffForHumans() }}</flux:table.cell>
                            <flux:table.cell class="text-right">
                                @if ($authRole->canManageMembers())
                                    <flux:button
                                        size="xs"
                                        variant="danger"
                                        icon="x-mark"
                                        wire:click="revokeInvitation({{ $invitation->id }})"
                                        wire:confirm="Revoke invitation for {{ $invitation->email }}?"
                                    >Revoke</flux:button>
                                @endif
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            <flux:separator class="my-8" />
        @endif

        <flux:heading size="sm">{{ __('Members') }}</flux:heading>
        <flux:table class="mt-3">
            <flux:table.columns>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column class="text-right">Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($members as $member)
                    @php($memberRole = \App\Enums\WorkspaceRole::from($member->pivot->role))
                    <flux:table.row :key="'mem-'.$member->id">
                        <flux:table.cell>
                            {{ $member->name }}
                            @if ($workspace && $member->id === $workspace->owner_id)
                                <flux:badge size="sm" variant="subtle" class="ms-1">Owner</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>{{ $member->email }}</flux:table.cell>
                        <flux:table.cell>
                            @if ($authRole?->canManageMembers() && $member->id !== $workspace->owner_id)
                                <flux:select size="sm" wire:change="changeRole({{ $member->id }}, $event.target.value)" :default="$memberRole->value">
                                    @foreach ($roleOptions as $role)
                                        <flux:select.option value="{{ $role->value }}" :selected="$role === $memberRole">{{ $role->label() }}</flux:select.option>
                                    @endforeach
                                </flux:select>
                            @else
                                {{ $memberRole->label() }}
                            @endif
                        </flux:table.cell>
                        <flux:table.cell class="text-right">
                            @if ($authRole?->canManageMembers() && $member->id !== $workspace->owner_id && $member->id !== auth()->id())
                                <flux:button
                                    size="xs"
                                    variant="danger"
                                    icon="user-minus"
                                    wire:click="removeMember({{ $member->id }})"
                                    wire:confirm="Remove {{ $member->name }} from this workspace?"
                                >Remove</flux:button>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </x-settings.layout>
</section>
