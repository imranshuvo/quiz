<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Settings\ApiTokens;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;

it('creates and revokes a scoped API token', function () {
    $user = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $user->id]);
    $workspace->attachMember($user, WorkspaceRole::Owner);
    $user->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    $component = Livewire::actingAs($user)->test(ApiTokens::class)
        ->set('tokenName', 'Automation')
        ->set('writeAccess', true)
        ->call('createToken')
        ->assertHasNoErrors();

    expect($component->get('plainTextToken'))->toContain('|');
    $token = $user->tokens()->first();
    expect($token->abilities)->toContain('content:write');

    Livewire::actingAs($user)->test(ApiTokens::class)
        ->call('revokeToken', $token->id);

    expect($user->tokens()->count())->toBe(0);
});
