<?php

use App\Enums\WorkspaceRole;
use App\Mail\WorkspaceInvitationMail;
use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceInvitation;
use Illuminate\Support\Facades\Mail;

it('issues an invitation that can be accepted by the matching email', function () {
    Mail::fake();

    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);

    $invitation = $workspace->invitations()->create([
        'invited_by' => $owner->id,
        'email' => 'newbie@example.com',
        'role' => WorkspaceRole::Editor,
    ]);

    expect($invitation->token)->not->toBeEmpty();
    expect($invitation->isPending())->toBeTrue();

    Mail::send(new WorkspaceInvitationMail($invitation));
    Mail::assertSent(WorkspaceInvitationMail::class);

    $invitee = User::factory()->create(['email' => 'newbie@example.com']);

    $this->actingAs($invitee)
        ->post(route('workspace-invitations.accept', $invitation->token))
        ->assertRedirect(route('dashboard'));

    $invitation->refresh();
    expect($invitation->isAccepted())->toBeTrue();
    expect($workspace->fresh()->hasMember($invitee))->toBeTrue();
    expect($invitee->fresh()->roleIn($workspace))->toBe(WorkspaceRole::Editor);
    expect($invitee->fresh()->current_workspace_id)->toBe($workspace->id);
});

it('rejects acceptance when the email does not match', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);

    $invitation = $workspace->invitations()->create([
        'invited_by' => $owner->id,
        'email' => 'intended@example.com',
        'role' => WorkspaceRole::Editor,
    ]);

    $imposter = User::factory()->create(['email' => 'someone-else@example.com']);

    $this->actingAs($imposter)
        ->post(route('workspace-invitations.accept', $invitation->token))
        ->assertForbidden();

    expect($workspace->fresh()->hasMember($imposter))->toBeFalse();
});

it('410 Gone when the invitation is expired', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);

    $invitation = $workspace->invitations()->create([
        'invited_by' => $owner->id,
        'email' => 'lapsed@example.com',
        'role' => WorkspaceRole::Editor,
        'expires_at' => now()->subDay(),
    ]);

    $this->get(route('workspace-invitations.show', $invitation->token))
        ->assertStatus(410);
});

it('redirects guests to register with the invited email pre-filled', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);

    $invitation = $workspace->invitations()->create([
        'invited_by' => $owner->id,
        'email' => 'newperson@example.com',
        'role' => WorkspaceRole::Editor,
    ]);

    $this->get(route('workspace-invitations.show', $invitation->token))
        ->assertRedirect(route('register', ['email' => 'newperson@example.com']));
});
