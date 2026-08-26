<?php

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Enums\QuestionType;
use App\Enums\WorkspaceRole;
use App\Livewire\Questionnaires\Editor;
use App\Livewire\Questionnaires\Index;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;

function ownerInWorkspace(): array
{
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    return [$owner, $workspace];
}

it('owner can create a questionnaire from the index', function () {
    [$owner, $workspace] = ownerInWorkspace();

    Livewire::actingAs($owner)->test(Index::class)
        ->set('newTitle', 'My first quiz')
        ->set('newKind', QuestionnaireKind::Survey->value)
        ->call('create')
        ->assertHasNoErrors();

    $created = Questionnaire::first();
    expect($created)->not->toBeNull();
    expect($created->title)->toBe('My first quiz');
    expect($created->kind)->toBe(QuestionnaireKind::Survey);
    expect($created->workspace_id)->toBe($workspace->id);
    expect($created->creator_id)->toBe($owner->id);
});

it('viewer is forbidden from creating questionnaires', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $viewer = User::factory()->create();
    $workspace->attachMember($viewer, WorkspaceRole::Viewer);
    $viewer->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    Livewire::actingAs($viewer)->test(Index::class)
        ->set('newTitle', 'should fail')
        ->set('newKind', QuestionnaireKind::Assessment->value)
        ->call('create')
        ->assertForbidden();

    expect(Questionnaire::withoutWorkspaceScope()->count())->toBe(0);
});

it('editor refuses to load a questionnaire from another workspace', function () {
    [$owner, $workspace] = ownerInWorkspace();

    $other = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($other);
    $foreign = Questionnaire::factory()->create();

    // Hit the actual route — the HTTP stack runs BootCurrentWorkspace, which
    // resolves the owner's workspace, and route-model binding then runs the
    // global scope, so the foreign questionnaire is invisible (404).
    $this->actingAs($owner)
        ->get(route('questionnaires.edit', $foreign))
        ->assertNotFound();
});

it('owner can add a question to their questionnaire', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('addQuestion', QuestionType::SingleChoice->value)
        ->call('addQuestion', QuestionType::ShortText->value);

    $questions = $q->fresh()->questions()->orderBy('position')->get();
    expect($questions)->toHaveCount(2);
    expect($questions[0]->type)->toBe(QuestionType::SingleChoice);
    expect($questions[1]->type)->toBe(QuestionType::ShortText);
    expect($questions[1]->position)->toBeGreaterThan($questions[0]->position);
});

it('addOption is no-op for non-choice question types', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);
    $textQuestion = Question::factory()->shortText()->forQuestionnaire($q)->create();

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('addOption', $textQuestion->id);

    expect($textQuestion->fresh()->options()->count())->toBe(0);
});

it('publish refuses if there are no questions', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('publish')
        ->assertHasErrors(['publish']);

    expect($q->fresh()->status)->toBe(QuestionnaireStatus::Draft);
});

it('publish succeeds once a question exists', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);
    Question::factory()->forQuestionnaire($q)->create();

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('publish')
        ->assertHasNoErrors();

    expect($q->fresh()->status)->toBe(QuestionnaireStatus::Published);
    expect($q->fresh()->published_at)->not->toBeNull();
});

it('saveDetails updates the title and description', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
        'title' => 'Old',
        'description' => 'Old desc',
    ]);

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->set('title', 'New title')
        ->set('description', 'Better description')
        ->call('saveDetails');

    expect($q->fresh()->title)->toBe('New title');
    expect($q->fresh()->description)->toBe('Better description');
});

it('deleteQuestion soft-deletes the question', function () {
    [$owner, $workspace] = ownerInWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id,
        'creator_id' => $owner->id,
    ]);
    $question = Question::factory()->forQuestionnaire($q)->create();

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('deleteQuestion', $question->id);

    expect($q->fresh()->questions()->count())->toBe(0);
    expect(Question::withTrashed()->count())->toBe(1);
});
