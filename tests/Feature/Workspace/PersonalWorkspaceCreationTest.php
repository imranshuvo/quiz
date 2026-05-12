<?php

use App\Enums\WorkspaceRole;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

it('creates a personal workspace when a user registers', function () {
    Event::fake([\Illuminate\Notifications\Events\NotificationSent::class]);

    $user = User::factory()->create(['name' => 'Ada Lovelace']);

    Event::dispatch(new Registered($user));

    $user->refresh();

    expect($user->workspaces)->toHaveCount(1);

    $workspace = $user->workspaces->first();
    expect($workspace->personal)->toBeTrue();
    expect($workspace->owner_id)->toBe($user->id);
    expect($workspace->name)->toContain('Ada');
    expect($user->current_workspace_id)->toBe($workspace->id);
    expect($user->roleIn($workspace))->toBe(WorkspaceRole::Owner);
});

it('skips personal workspace creation if the user already belongs to one', function () {
    $existingOwner = User::factory()->create();
    $workspace = $existingOwner->ownedWorkspaces()->create([
        'name' => 'Acme',
        'personal' => false,
    ]);
    $workspace->attachMember($existingOwner, WorkspaceRole::Owner);

    $invitee = User::factory()->create();
    $workspace->attachMember($invitee, WorkspaceRole::Editor);

    Event::dispatch(new Registered($invitee));

    expect($invitee->fresh()->workspaces)->toHaveCount(1);
    expect($invitee->fresh()->workspaces->first()->name)->toBe('Acme');
});
