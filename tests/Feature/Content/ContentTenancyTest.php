<?php

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Tenancy;

it('hides questionnaires from other workspaces', function () {
    $a = Workspace::factory()->create();
    $b = Workspace::factory()->create();

    app(Tenancy::class)->setCurrent($a);
    Questionnaire::factory()->count(2)->create();
    app(Tenancy::class)->setCurrent($b);
    Questionnaire::factory()->count(1)->create();

    expect(Questionnaire::count())->toBe(1);
    app(Tenancy::class)->setCurrent($a);
    expect(Questionnaire::count())->toBe(2);
});

it('hides questions, options, responses, and answers from other workspaces', function () {
    $a = Workspace::factory()->create();
    $b = Workspace::factory()->create();

    app(Tenancy::class)->setCurrent($a);
    $qA = Questionnaire::factory()->create();
    $questionA = Question::factory()->forQuestionnaire($qA)->create();
    QuestionOption::factory()->forQuestion($questionA)->create();
    $responseA = Response::factory()->forQuestionnaire($qA)->create();
    ResponseAnswer::factory()->pair($responseA, $questionA)->create();

    app(Tenancy::class)->setCurrent($b);
    $qB = Questionnaire::factory()->create();
    $questionB = Question::factory()->forQuestionnaire($qB)->create();
    QuestionOption::factory()->forQuestion($questionB)->create();
    $responseB = Response::factory()->forQuestionnaire($qB)->create();
    ResponseAnswer::factory()->pair($responseB, $questionB)->create();

    // From workspace B's perspective only B's rows visible.
    expect(Questionnaire::count())->toBe(1);
    expect(Question::count())->toBe(1);
    expect(QuestionOption::count())->toBe(1);
    expect(Response::count())->toBe(1);
    expect(ResponseAnswer::count())->toBe(1);

    expect(Questionnaire::first()->id)->toBe($qB->id);

    // Switch back to A.
    app(Tenancy::class)->setCurrent($a);
    expect(Questionnaire::first()->id)->toBe($qA->id);
});

it('zero rows are returned across all five models when no current workspace', function () {
    $w = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($w);

    $q = Questionnaire::factory()->create();
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->create();
    $r = Response::factory()->forQuestionnaire($q)->create();
    ResponseAnswer::factory()->pair($r, $question)->create();

    app(Tenancy::class)->setCurrent(null);

    expect(Questionnaire::count())->toBe(0);
    expect(Question::count())->toBe(0);
    expect(QuestionOption::count())->toBe(0);
    expect(Response::count())->toBe(0);
    expect(ResponseAnswer::count())->toBe(0);

    // Opt-out still works.
    expect(Questionnaire::withoutWorkspaceScope()->count())->toBe(1);
});
