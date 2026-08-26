<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Settings\AuditLog;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;

it('records workspace content changes and shows them to admins', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    app(Tenancy::class)->setCurrent($workspace);

    $questionnaire = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
        'title' => 'Original title',
    ]);
    $questionnaire->update(['title' => 'Revised title']);

    expect(Activity::where('properties->workspace_id', $workspace->id)->count())->toBeGreaterThan(0);

    Livewire::actingAs($owner)->test(AuditLog::class)
        ->assertOk()
        ->assertSee('Questionnaire');
});

it('forbids viewers from the audit log', function () {
    $viewer = User::factory()->create();
    $workspace = Workspace::factory()->create();
    $workspace->attachMember($viewer, WorkspaceRole::Viewer);
    app(Tenancy::class)->setCurrent($workspace);

    Livewire::actingAs($viewer)->test(AuditLog::class)->assertForbidden();
});
