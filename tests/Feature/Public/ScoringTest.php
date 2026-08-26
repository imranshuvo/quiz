<?php

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Scoring;
use App\Services\Tenancy;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
    $this->scoring = app(Scoring::class);
});

it('scores a single-choice answer by the picked option score', function () {
    $q = Questionnaire::factory()->create();
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'a', 'is_correct' => false, 'score' => 0]);
    QuestionOption::factory()->forQuestion($question)->correct(2)->create(['value' => 'b']);

    [$correct, $score] = $this->scoring->scoreAnswer($question, ['b']);
    expect($correct)->toBeTrue();
    expect($score)->toBe(2.0);

    [$correct2, $score2] = $this->scoring->scoreAnswer($question, ['a']);
    expect($correct2)->toBeFalse();
    expect($score2)->toBe(0.0);
});

it('scores multi-choice all-or-nothing', function () {
    $q = Questionnaire::factory()->create();
    $question = Question::factory()->multiChoice()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->correct(1)->create(['value' => 'a']);
    QuestionOption::factory()->forQuestion($question)->correct(1)->create(['value' => 'b']);
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'c']);

    // Exactly the correct set → full credit.
    expect($this->scoring->scoreAnswer($question, ['a', 'b']))->toBe([true, 2.0]);
    // Order doesn't matter.
    expect($this->scoring->scoreAnswer($question, ['b', 'a']))->toBe([true, 2.0]);
    // Missing one → zero.
    expect($this->scoring->scoreAnswer($question, ['a']))->toBe([false, 0.0]);
    // Extra wrong → zero.
    expect($this->scoring->scoreAnswer($question, ['a', 'b', 'c']))->toBe([false, 0.0]);
});

it('returns null score for non-auto-gradable types', function () {
    $q = Questionnaire::factory()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($q)->create();

    expect($this->scoring->scoreAnswer($textQ, ['anything']))->toBe([null, null]);
});

it('scoreResponse persists totals on a graded response', function () {
    $q = Questionnaire::factory()->create();
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->correct(3)->create(['value' => 'right']);
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'wrong']);

    $r = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r, $question)->create(['value' => ['right']]);

    $this->scoring->scoreResponse($r->fresh());

    expect((float) $r->fresh()->score)->toBe(3.0);
    expect((float) $r->fresh()->max_score)->toBe(3.0);
});

it('scoreResponse leaves score null for non-graded kinds', function () {
    $q = Questionnaire::factory()->survey()->create();
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'a']);

    $r = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r, $question)->create(['value' => ['a']]);

    $this->scoring->scoreResponse($r->fresh());

    expect($r->fresh()->score)->toBeNull();
    expect($r->fresh()->max_score)->toBeNull();
});
