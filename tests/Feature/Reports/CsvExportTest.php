<?php

use App\Enums\WorkspaceRole;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Reports\CsvExporter;
use App\Services\Tenancy;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('CsvExporter streams a header row + one row per submitted response', function () {
    $q = Questionnaire::factory()->create([
        'workspace_id' => $this->workspace->id,
        'title' => 'Demo',
    ]);
    $q1 = Question::factory()->forQuestionnaire($q)->create(['title' => 'Color?']);
    $q2 = Question::factory()->shortText()->forQuestionnaire($q)->create(['title' => 'Why?']);

    $r1 = Response::factory()->forQuestionnaire($q)->submitted()->create([
        'respondent_email' => 'a@example.com', 'score' => 1, 'max_score' => 1,
    ]);
    ResponseAnswer::factory()->pair($r1, $q1)->create(['value' => ['blue']]);
    ResponseAnswer::factory()->pair($r1, $q2)->create(['value' => ['it is the sky']]);

    $r2 = Response::factory()->forQuestionnaire($q)->submitted()->create([
        'respondent_email' => 'b@example.com',
    ]);
    ResponseAnswer::factory()->pair($r2, $q1)->create(['value' => ['red', 'green']]);

    // in-progress, should be excluded
    Response::factory()->forQuestionnaire($q)->create();

    $stream = app(CsvExporter::class)->streamFor($q);
    ob_start();
    $stream->sendContent();
    $csv = ob_get_clean();

    $lines = array_values(array_filter(explode("\n", trim($csv))));
    expect($lines)->toHaveCount(3); // header + 2 submitted

    expect($lines[0])->toContain('response_id');
    expect($lines[0])->toContain('Color?');
    expect($lines[0])->toContain('Why?');

    expect($lines[1])->toContain('a@example.com');
    expect($lines[1])->toContain('blue');
    expect($lines[1])->toContain('it is the sky');

    // Multi-value answers join with " | "
    expect($lines[2])->toContain('red | green');
});

it('the CSV download route enforces tenancy + edit permission', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);

    $this->actingAs($owner)
        ->get(route('questionnaires.responses.export', $q))
        ->assertOk()
        ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

    // Foreign workspace 404 (route binding scope)
    app(Tenancy::class)->setCurrent(Workspace::factory()->create());
    $foreign = Questionnaire::factory()->create();
    app(Tenancy::class)->setCurrent($workspace);

    $this->actingAs($owner)
        ->get(route('questionnaires.responses.export', $foreign))
        ->assertNotFound();
});
