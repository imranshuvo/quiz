<x-mail::message>
# You've been invited to join {{ $invitation->workspace->name }}

{{ $invitation->inviter->name }} has invited you to collaborate as a **{{ $invitation->role->label() }}**.

This invitation expires {{ $invitation->expires_at->diffForHumans() }}.

<x-mail::button :url="$acceptUrl">
Accept invitation
</x-mail::button>

If you didn't expect this email, you can safely ignore it.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
