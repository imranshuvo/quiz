<?php

use App\Enums\ResponseStatus;
use App\Livewire\Public\Leaderboard;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\Workspace;
use App\Services\Tenancy;
use Livewire\Livewire;

it('orders submitted assessment results by percentage', function () {
    $workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($workspace);
    $questionnaire = Questionnaire::factory()->published()->create(['workspace_id' => $workspace->id]);

    Response::factory()->forQuestionnaire($questionnaire)->create([
        'status' => ResponseStatus::Submitted,
        'score' => 4,
        'max_score' => 10,
        'submitted_at' => now(),
    ]);
    Response::factory()->forQuestionnaire($questionnaire)->create([
        'status' => ResponseStatus::Submitted,
        'score' => 9,
        'max_score' => 10,
        'submitted_at' => now(),
    ]);

    Livewire::test(Leaderboard::class, ['slug' => $questionnaire->slug])
        ->assertOk()
        ->assertSeeInOrder(['90%', '40%']);
});
