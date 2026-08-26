<?php

use App\Enums\WorkspaceRole;
use App\Livewire\Questionnaires\Editor;
use App\Livewire\Questionnaires\Index;
use App\Livewire\Questionnaires\Webhooks as WebhooksPage;
use App\Livewire\Settings\Members;
use App\Models\AiUsage;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;

function ownerWorkspace(): array
{
    $owner = User::factory()->create();
    $workspace = Workspace::factory()->create(['owner_id' => $owner->id]);
    $workspace->attachMember($owner, WorkspaceRole::Owner);
    $owner->forceFill(['current_workspace_id' => $workspace->id])->save();
    app(Tenancy::class)->setCurrent($workspace);

    return [$owner, $workspace];
}

it('the questionnaire create modal blocks beyond the Free plan limit', function () {
    [$owner, $workspace] = ownerWorkspace();
    Questionnaire::factory()->count(3)->create(['workspace_id' => $workspace->id]); // hit free limit

    Livewire::actingAs($owner)->test(Index::class)
        ->set('newTitle', 'One too many')
        ->set('newKind', 'survey')
        ->call('create')
        ->assertHasErrors(['plan']);

    expect(Questionnaire::withoutWorkspaceScope()->count())->toBe(3);
});

it('the AI generate action blocks once the AI call limit is hit', function () {
    [$owner, $workspace] = ownerWorkspace();

    // Spend 20 AI calls (free limit).
    for ($i = 0; $i < 20; $i++) {
        AiUsage::create([
            'workspace_id' => $workspace->id,
            'kind' => 'generate_questions', 'provider' => 'fake', 'model' => 'fake',
            'prompt_tokens' => 1, 'completion_tokens' => 1, 'cost_cents' => 1,
        ]);
    }

    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id, 'creator_id' => $owner->id,
    ]);

    $component = Livewire::actingAs($owner)->test(Editor::class, ['questionnaire' => $q])
        ->set('aiTopic', 'A topic with content')
        ->set('aiCount', 3)
        ->call('generateWithAi');

    expect($component->get('aiError'))->toContain('AI call limit');
});

it('the webhook create action blocks on the Free plan (limit 0)', function () {
    [$owner, $workspace] = ownerWorkspace();
    $q = Questionnaire::factory()->create([
        'workspace_id' => $workspace->id, 'creator_id' => $owner->id,
    ]);

    Livewire::actingAs($owner)->test(WebhooksPage::class, ['questionnaire' => $q])
        ->set('newName', 'Slack')
        ->set('newUrl', 'https://example.com/hook')
        ->call('create')
        ->assertHasErrors(['newUrl']);

    expect(WebhookEndpoint::withoutWorkspaceScope()->count())->toBe(0);
});

it('the member invite action blocks once team limit is hit', function () {
    [$owner, $workspace] = ownerWorkspace();
    // Free plan: 1 team member. Owner already counts as 1 → blocked.

    Livewire::actingAs($owner)->test(Members::class)
        ->set('inviteEmail', 'newbie@example.com')
        ->set('inviteRole', 'editor')
        ->call('sendInvitation')
        ->assertHasErrors(['inviteEmail']);
});

it('the billing settings page renders without throwing', function () {
    [$owner, $workspace] = ownerWorkspace();

    $this->actingAs($owner)
        ->get(route('settings.billing'))
        ->assertOk()
        ->assertSee('Billing')
        ->assertSee('Free');
});
