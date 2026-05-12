<div>
    @if ($current)
        <flux:dropdown align="start">
            <flux:button variant="ghost" icon-trailing="chevrons-up-down" class="!justify-start max-w-56">
                <span class="truncate">{{ $current->name }}</span>
            </flux:button>

            <flux:menu>
                <flux:menu.group heading="Workspaces">
                    @foreach ($workspaces as $workspace)
                        <flux:menu.item
                            wire:click="switch({{ $workspace->id }})"
                            :icon="$workspace->id === $current->id ? 'check' : null"
                        >
                            <span class="truncate">{{ $workspace->name }}</span>
                            @if ($workspace->personal)
                                <flux:badge size="sm" variant="subtle" class="ms-2">Personal</flux:badge>
                            @endif
                        </flux:menu.item>
                    @endforeach
                </flux:menu.group>

                <flux:menu.separator />

                <flux:menu.item icon="users" :href="route('settings.members')" wire:navigate>
                    Manage members
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    @endif
</div>
