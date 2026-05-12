<x-layouts.auth>
    <div class="flex flex-col gap-6 text-center">
        <flux:heading size="xl">Invitation no longer valid</flux:heading>
        <flux:text>
            @if ($invitation->isAccepted())
                This invitation has already been accepted.
            @else
                This invitation has expired.
            @endif
            Ask the workspace owner to send a new invitation.
        </flux:text>
        <flux:button :href="route('home')" variant="primary">
            Go home
        </flux:button>
    </div>
</x-layouts.auth>
