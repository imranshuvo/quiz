<?php

use App\Enums\WorkspaceRole;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;

it('exports a valid tenant-scoped PDF analytics report', function () {
    $user = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $user->id]);
    $workspace->attachMember($user, WorkspaceRole::Owner);
    $user->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);
    $questionnaire = Questionnaire::factory()->create(['workspace_id' => $workspace->id, 'creator_id' => $user->id]);

    $response = $this->actingAs($user)->get(route('questionnaires.analytics.pdf', $questionnaire));

    $response->assertOk()->assertHeader('content-type', 'application/pdf');
    expect($response->getContent())->toStartWith('%PDF-1.4');
});
