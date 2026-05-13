<?php

namespace App\Livewire\Settings;

use App\Enums\WorkspaceRole;
use App\Mail\WorkspaceInvitationMail;
use App\Models\WorkspaceInvitation;
use App\Services\Billing\Limits;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Members extends Component
{
    #[Validate('required|email|max:255')]
    public string $inviteEmail = '';

    #[Validate('required')]
    public string $inviteRole = WorkspaceRole::Editor->value;

    public function rules(): array
    {
        return [
            'inviteEmail' => ['required', 'email', 'max:255'],
            'inviteRole' => ['required', Rule::in(array_map(fn ($r) => $r->value, WorkspaceRole::assignable()))],
        ];
    }

    public function sendInvitation(Tenancy $tenancy, Limits $limits): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);

        $user = auth()->user();
        $role = $user->roleIn($workspace);
        abort_unless($role && $role->canManageMembers(), 403);

        $this->validate();

        if (! $limits->canInviteMember($workspace)) {
            $this->addError('inviteEmail', 'Your plan\'s team-member limit has been reached. Upgrade to invite more.');
            return;
        }

        // No duplicate active invites for same email + workspace.
        if ($workspace->invitations()
            ->where('email', $this->inviteEmail)
            ->whereNull('accepted_at')
            ->where('expires_at', '>', now())
            ->exists()
        ) {
            $this->addError('inviteEmail', 'A pending invitation already exists for that address.');
            return;
        }

        // No-op if they're already a member.
        if ($workspace->members()->where('users.email', $this->inviteEmail)->exists()) {
            $this->addError('inviteEmail', 'That user is already a member.');
            return;
        }

        $invitation = $workspace->invitations()->create([
            'invited_by' => $user->id,
            'email' => $this->inviteEmail,
            'role' => $this->inviteRole,
        ]);

        Mail::to($this->inviteEmail)->send(new WorkspaceInvitationMail($invitation));

        $this->reset('inviteEmail');
        $this->dispatch('member-invited', email: $invitation->email);
    }

    public function revokeInvitation(int $invitationId, Tenancy $tenancy): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canManageMembers(), 403);

        $workspace->invitations()->where('id', $invitationId)->delete();
    }

    public function removeMember(int $userId, Tenancy $tenancy): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canManageMembers(), 403);

        if ($workspace->owner_id === $userId) {
            $this->addError('removal', "The workspace owner can't be removed.");
            return;
        }

        // Self-removal would lock the user out of the workspace mid-session.
        // Use "leave workspace" UI for that (Phase 2.5 polish).
        if ($userId === auth()->id()) {
            $this->addError('removal', "You can't remove yourself here.");
            return;
        }

        $workspace->members()->detach($userId);
    }

    public function changeRole(int $userId, string $role, Tenancy $tenancy): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canManageMembers(), 403);

        $newRole = WorkspaceRole::from($role);

        // Owner role isn't changeable via this UI; needs an explicit transfer flow.
        if ($workspace->owner_id === $userId) {
            return;
        }

        // Don't allow demoting yourself out of admin in the same step that
        // would leave you unable to undo the action.
        if ($userId === auth()->id() && ! $newRole->canManageMembers()) {
            $this->addError('role', "You can't demote yourself out of admin here.");
            return;
        }

        $workspace->memberships()->where('user_id', $userId)->update(['role' => $newRole->value]);
    }

    public function render(Tenancy $tenancy): View
    {
        $workspace = $tenancy->current();

        $members = $workspace
            ? $workspace->members()->orderBy('users.name')->get()
            : collect();

        $invitations = $workspace
            ? $workspace->invitations()->whereNull('accepted_at')->latest()->get()
            : collect();

        $authRole = $workspace ? auth()->user()->roleIn($workspace) : null;

        return view('livewire.settings.members', [
            'workspace' => $workspace,
            'members' => $members,
            'invitations' => $invitations,
            'authRole' => $authRole,
            'roleOptions' => WorkspaceRole::assignable(),
        ]);
    }
}
