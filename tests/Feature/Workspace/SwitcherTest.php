<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Workspace\Switcher;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;

it('switches to a workspace the user is a member of', function () {
    $user = User::factory()->create();
    $a = Workspace::factory()->create(['owner_id' => $user->id]);
    $b = Workspace::factory()->create(['owner_id' => $user->id]);
    $a->attachMember($user, WorkspaceRole::Owner);
    $b->attachMember($user, WorkspaceRole::Owner);
    $user->forceFill(['current_workspace_id' => $a->id])->save();

    Livewire::actingAs($user)->test(Switcher::class)
        ->call('switch', $b->id);

    expect($user->fresh()->current_workspace_id)->toBe($b->id);
});

it('refuses to switch to a workspace the user does not belong to', function () {
    $user = User::factory()->create();
    $own = Workspace::factory()->create(['owner_id' => $user->id]);
    $own->attachMember($user, WorkspaceRole::Owner);
    $user->forceFill(['current_workspace_id' => $own->id])->save();

    $stranger = Workspace::factory()->create();

    Livewire::actingAs($user)->test(Switcher::class)
        ->call('switch', $stranger->id);

    expect($user->fresh()->current_workspace_id)->toBe($own->id);
    expect($stranger->fresh()->hasMember($user))->toBeFalse();
});

it('Tenancy::resolveFor falls back when current_workspace_id is null', function () {
    $user = User::factory()->create();
    $alive = Workspace::factory()->create(['owner_id' => $user->id]);
    $alive->attachMember($user, WorkspaceRole::Owner);

    // No current set; resolveFor should pick the first they belong to and persist it.
    expect($user->current_workspace_id)->toBeNull();

    $resolved = app(Tenancy::class)->resolveFor($user->fresh());

    expect($resolved->id)->toBe($alive->id);
    expect($user->fresh()->current_workspace_id)->toBe($alive->id);
});

it('Tenancy::resolveFor reassigns when the current workspace is no longer accessible', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $mine = Workspace::factory()->create(['owner_id' => $user->id]);
    $mine->attachMember($user, WorkspaceRole::Owner);
    $theirs = Workspace::factory()->create(['owner_id' => $other->id]);
    $theirs->attachMember($other, WorkspaceRole::Owner);

    // User points at a real workspace they don't belong to.
    $user->forceFill(['current_workspace_id' => $theirs->id])->save();

    $resolved = app(Tenancy::class)->resolveFor($user->fresh());

    expect($resolved->id)->toBe($mine->id);
    expect($user->fresh()->current_workspace_id)->toBe($mine->id);
});
