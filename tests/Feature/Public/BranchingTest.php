<?php

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Response;
use App\Models\Workspace;
use App\Services\Branching;
use App\Services\Tenancy;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
    $this->branching = app(Branching::class);
});

it('falls through to the next question by position when no rules match', function () {
    $q = Questionnaire::factory()->create();
    $q1 = Question::factory()->forQuestionnaire($q)->create(['position' => 1]);
    $q2 = Question::factory()->forQuestionnaire($q)->create(['position' => 2]);

    $r = Response::factory()->forQuestionnaire($q)->create();

    expect($this->branching->nextQuestionId($q1, ['a'], $r))->toBe($q2->id);
});

it('returns null at the end of the questionnaire (fall-through)', function () {
    $q = Questionnaire::factory()->create();
    $only = Question::factory()->forQuestionnaire($q)->create(['position' => 1]);
    $r = Response::factory()->forQuestionnaire($q)->create();

    expect($this->branching->nextQuestionId($only, ['x'], $r))->toBeNull();
});

it('respects an "end" action immediately', function () {
    $q = Questionnaire::factory()->create();
    $q1 = Question::factory()->forQuestionnaire($q)->create([
        'position' => 1,
        'branching' => [
            ['when' => ['operator' => 'equals', 'value' => 'no'], 'action' => ['type' => 'end']],
        ],
    ]);
    Question::factory()->forQuestionnaire($q)->create(['position' => 2]); // would be next, but skipped
    $r = Response::factory()->forQuestionnaire($q)->create();

    expect($this->branching->nextQuestionId($q1, ['no'], $r))->toBeNull();
});

it('skip_to jumps to the named question id', function () {
    $q = Questionnaire::factory()->create();
    $q1 = Question::factory()->forQuestionnaire($q)->create(['position' => 1]);
    $q2 = Question::factory()->forQuestionnaire($q)->create(['position' => 2]);
    $q3 = Question::factory()->forQuestionnaire($q)->create(['position' => 3]);

    $q1->forceFill(['branching' => [
        ['when' => ['operator' => 'in', 'value' => ['yes', 'maybe']], 'action' => ['type' => 'skip_to', 'question_id' => $q3->id]],
    ]])->save();

    $r = Response::factory()->forQuestionnaire($q)->create();
    expect($this->branching->nextQuestionId($q1->fresh(), ['yes'], $r))->toBe($q3->id);
    // Non-matching answer falls through to q2.
    expect($this->branching->nextQuestionId($q1->fresh(), ['no'], $r))->toBe($q2->id);
});

it('"any" operator matches when any non-empty answer is given', function () {
    $q = Questionnaire::factory()->create();
    $q1 = Question::factory()->forQuestionnaire($q)->create([
        'position' => 1,
        'branching' => [
            ['when' => ['operator' => 'any'], 'action' => ['type' => 'end']],
        ],
    ]);
    Question::factory()->forQuestionnaire($q)->create(['position' => 2]);
    $r = Response::factory()->forQuestionnaire($q)->create();

    expect($this->branching->nextQuestionId($q1, ['something'], $r))->toBeNull();
});

it('adaptive difficulty moves up after a correct answer', function () {
    $q = Questionnaire::factory()->create(['settings' => ['adaptive_difficulty' => true]]);
    $current = Question::factory()->forQuestionnaire($q)->create(['position' => 1, 'meta' => ['difficulty' => 2]]);
    QuestionOption::factory()->forQuestion($current)->correct(1)->create(['value' => 'right']);
    $easier = Question::factory()->forQuestionnaire($q)->create(['position' => 2, 'meta' => ['difficulty' => 1]]);
    $harder = Question::factory()->forQuestionnaire($q)->create(['position' => 3, 'meta' => ['difficulty' => 3]]);
    $response = Response::factory()->forQuestionnaire($q)->create();

    expect($this->branching->nextQuestionId($current, ['right'], $response))->toBe($harder->id);
    expect($this->branching->nextQuestionId($current, ['wrong'], $response))->toBe($easier->id);
});
