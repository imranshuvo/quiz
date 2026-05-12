<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Questionnaires\Editor;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\ValueObjects\Usage;

it('the editor can generate questions with AI and persist them', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    Prism::fake([
        StructuredResponseFake::make()->withStructured([
            'questions' => [
                [
                    'title' => 'Whats 1+1?',
                    'helper' => '',
                    'type' => 'single_choice',
                    'required' => true,
                    'options' => [
                        ['label' => '1', 'value' => 'one', 'is_correct' => false, 'score' => 0],
                        ['label' => '2', 'value' => 'two', 'is_correct' => true, 'score' => 1],
                    ],
                ],
            ],
        ])->withUsage(new Usage(100, 50)),
    ]);

    $q = Questionnaire::factory()->create(['workspace_id' => $workspace->id, 'creator_id' => $owner->id]);

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->call('openAiGenerate')
        ->assertSet('showAiGenerate', true)
        ->set('aiTopic', 'Basic arithmetic for first graders')
        ->set('aiCount', 1)
        ->call('generateWithAi')
        ->assertHasNoErrors()
        ->assertSet('showAiGenerate', false);

    expect($q->fresh()->questions()->count())->toBe(1);
    expect($q->fresh()->questions->first()->title)->toBe('Whats 1+1?');
});

it('validates the AI topic field', function () {
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    $q = Questionnaire::factory()->create(['workspace_id' => $workspace->id, 'creator_id' => $owner->id]);

    Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->set('aiTopic', '')
        ->call('generateWithAi')
        ->assertHasErrors(['aiTopic']);
});
