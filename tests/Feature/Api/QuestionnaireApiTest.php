<?php

use App\Enums\WorkspaceRole;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;

function apiWorkspace(WorkspaceRole $role = WorkspaceRole::Owner): array
{
    $user = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $user->id]);
    $workspace->attachMember($user, $role);
    $user->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    return [$user, $workspace];
}

it('requires a Sanctum token for the API', function () {
    $this->getJson('/api/v1/questionnaires')->assertUnauthorized();
});

it('lists only questionnaires in the selected workspace', function () {
    [$user, $workspace] = apiWorkspace();
    $visible = Questionnaire::factory()->create(['workspace_id' => $workspace->id, 'creator_id' => $user->id]);

    $other = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($other);
    Questionnaire::factory()->create(['workspace_id' => $other->id]);

    $token = $user->createToken('test', ['workspace:read', 'content:read'])->plainTextToken;
    app(Tenancy::class)->setCurrent(null);

    $this->withToken($token)
        ->getJson('/api/v1/questionnaires')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $visible->id);
});

it('boots tenancy before scoped route-model binding', function () {
    [$user, $workspace] = apiWorkspace();
    $questionnaire = Questionnaire::factory()->create(['workspace_id' => $workspace->id, 'creator_id' => $user->id]);
    $token = $user->createToken('test', ['workspace:read', 'content:read'])->plainTextToken;
    app(Tenancy::class)->setCurrent(null);

    $this->withToken($token)
        ->getJson("/api/v1/questionnaires/{$questionnaire->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $questionnaire->id);
});

it('can select another member workspace with the header', function () {
    [$user, $first] = apiWorkspace();
    $second = Workspace::factory()->create();
    $second->attachMember($user, WorkspaceRole::Editor);

    app(Tenancy::class)->setCurrent($second);
    $questionnaire = Questionnaire::factory()->create(['workspace_id' => $second->id, 'creator_id' => $user->id]);

    $token = $user->createToken('test', ['workspace:read', 'content:read'])->plainTextToken;

    $this->withToken($token)
        ->withHeader('X-Workspace', $second->slug)
        ->getJson('/api/v1/questionnaires')
        ->assertOk()
        ->assertJsonPath('data.0.id', $questionnaire->id);
});

it('write-scoped editors can create questionnaire content', function () {
    [$user, $workspace] = apiWorkspace(WorkspaceRole::Editor);
    $token = $user->createToken('writer', ['workspace:read', 'content:read', 'content:write'])->plainTextToken;

    $response = $this->withToken($token)->postJson('/api/v1/questionnaires', [
        'title' => 'API quiz',
        'kind' => 'assessment',
    ])->assertCreated();

    $id = $response->json('data.id');
    expect(Questionnaire::withoutWorkspaceScope()->find($id)->workspace_id)->toBe($workspace->id);

    $this->withToken($token)->postJson("/api/v1/questionnaires/{$id}/questions", [
        'title' => 'What is 2 + 2?',
        'type' => 'short_text',
        'required' => true,
    ])->assertCreated()->assertJsonPath('data.title', 'What is 2 + 2?');
});

it('read-only tokens cannot mutate content', function () {
    [$user] = apiWorkspace();
    $token = $user->createToken('reader', ['workspace:read', 'content:read'])->plainTextToken;

    $this->withToken($token)->postJson('/api/v1/questionnaires', [
        'title' => 'Blocked',
        'kind' => 'survey',
    ])->assertForbidden();
});

it('viewers cannot write even with a write-scoped token', function () {
    [$user] = apiWorkspace(WorkspaceRole::Viewer);
    $token = $user->createToken('viewer', ['workspace:read', 'content:read', 'content:write'])->plainTextToken;

    $this->withToken($token)->postJson('/api/v1/questionnaires', [
        'title' => 'Blocked',
        'kind' => 'survey',
    ])->assertForbidden();
});
