<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <flux:heading size="xl">Join {{ $invitation->workspace->name }}</flux:heading>
        <flux:text>
            <strong>{{ $invitation->inviter->name }}</strong> invited you to join the workspace
            <strong>{{ $invitation->workspace->name }}</strong> as a
            <strong>{{ $invitation->role->label() }}</strong>.
        </flux:text>

        @if (auth()->check() && strcasecmp(auth()->user()->email, $invitation->email) !== 0)
            <flux:callout icon="exclamation-triangle" color="amber">
                This invitation was sent to <strong>{{ $invitation->email }}</strong> but you're signed in as
                <strong>{{ auth()->user()->email }}</strong>. Sign in with the matching account to accept.
            </flux:callout>
        @endif

        <form method="POST" action="{{ route('workspace-invitations.accept', $invitation->token) }}">
            @csrf
            <flux:button type="submit" variant="primary" icon="check" class="w-full">
                Accept invitation
            </flux:button>
        </form>

        <flux:text size="sm" class="text-center">
            Expires {{ $invitation->expires_at->diffForHumans() }}.
        </flux:text>
    </div>
</x-layouts.auth>
