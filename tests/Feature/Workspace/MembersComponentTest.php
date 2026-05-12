<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Settings\Members;
use App\Mail\WorkspaceInvitationMail;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

function workspaceWithOwner(): array
{
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    return [$owner, $workspace];
}

it('lets an owner invite a new member by email', function () {
    Mail::fake();
    [$owner, $workspace] = workspaceWithOwner();

    Livewire::actingAs($owner)->test(Members::class)
        ->set('inviteEmail', 'newbie@example.com')
        ->set('inviteRole', WorkspaceRole::Editor->value)
        ->call('sendInvitation')
        ->assertHasNoErrors();

    Mail::assertSent(WorkspaceInvitationMail::class);
    expect($workspace->fresh()->invitations()->count())->toBe(1);
});

it('rejects duplicate pending invites for the same email', function () {
    Mail::fake();
    [$owner, $workspace] = workspaceWithOwner();

    $workspace->invitations()->create([
        'invited_by' => $owner->id,
        'email' => 'dup@example.com',
        'role' => WorkspaceRole::Editor,
    ]);

    Livewire::actingAs($owner)->test(Members::class)
        ->set('inviteEmail', 'dup@example.com')
        ->set('inviteRole', WorkspaceRole::Editor->value)
        ->call('sendInvitation')
        ->assertHasErrors(['inviteEmail']);

    Mail::assertNotSent(WorkspaceInvitationMail::class);
});

it('rejects inviting a user who is already a member', function () {
    Mail::fake();
    [$owner, $workspace] = workspaceWithOwner();
    $existing = User::factory()->create(['email' => 'on-team@example.com']);
    $workspace->attachMember($existing, WorkspaceRole::Editor);

    Livewire::actingAs($owner)->test(Members::class)
        ->set('inviteEmail', 'on-team@example.com')
        ->set('inviteRole', WorkspaceRole::Editor->value)
        ->call('sendInvitation')
        ->assertHasErrors(['inviteEmail']);
});

it('forbids viewers from inviting', function () {
    [$owner, $workspace] = workspaceWithOwner();
    $viewer = User::factory()->create();
    $workspace->attachMember($viewer, WorkspaceRole::Viewer);
    $viewer->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    Livewire::actingAs($viewer)->test(Members::class)
        ->set('inviteEmail', 'should-fail@example.com')
        ->set('inviteRole', WorkspaceRole::Editor->value)
        ->call('sendInvitation')
        ->assertForbidden();
});

it('blocks the owner from being removed', function () {
    [$owner, $workspace] = workspaceWithOwner();

    Livewire::actingAs($owner)->test(Members::class)
        ->call('removeMember', $owner->id)
        ->assertHasErrors(['removal']);

    expect($workspace->fresh()->hasMember($owner))->toBeTrue();
});

it('blocks self-removal even for an admin', function () {
    [$owner, $workspace] = workspaceWithOwner();
    $admin = User::factory()->create();
    $workspace->attachMember($admin, WorkspaceRole::Admin);
    $admin->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    Livewire::actingAs($admin)->test(Members::class)
        ->call('removeMember', $admin->id)
        ->assertHasErrors(['removal']);

    expect($workspace->fresh()->hasMember($admin))->toBeTrue();
});

it('blocks an admin from demoting themselves out of admin', function () {
    [$owner, $workspace] = workspaceWithOwner();
    $admin = User::factory()->create();
    $workspace->attachMember($admin, WorkspaceRole::Admin);
    $admin->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    Livewire::actingAs($admin)->test(Members::class)
        ->call('changeRole', $admin->id, WorkspaceRole::Viewer->value)
        ->assertHasErrors(['role']);

    expect($admin->fresh()->roleIn($workspace))->toBe(WorkspaceRole::Admin);
});

it('lets owner change a non-owner member role', function () {
    [$owner, $workspace] = workspaceWithOwner();
    $member = User::factory()->create();
    $workspace->attachMember($member, WorkspaceRole::Viewer);

    Livewire::actingAs($owner)->test(Members::class)
        ->call('changeRole', $member->id, WorkspaceRole::Editor->value)
        ->assertHasNoErrors();

    expect($member->fresh()->roleIn($workspace))->toBe(WorkspaceRole::Editor);
});
