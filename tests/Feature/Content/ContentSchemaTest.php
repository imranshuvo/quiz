<?php

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Tenancy;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('creates a questionnaire with a unique slug and draft status', function () {
    $q = Questionnaire::factory()->create();

    expect($q->slug)->not->toBeEmpty();
    expect($q->status)->toBe(QuestionnaireStatus::Draft);
    expect($q->kind)->toBe(QuestionnaireKind::Assessment);
});

it('publishes a questionnaire and stamps published_at', function () {
    $q = Questionnaire::factory()->create();
    expect($q->published_at)->toBeNull();

    $q->publish();

    expect($q->fresh()->status)->toBe(QuestionnaireStatus::Published);
    expect($q->fresh()->published_at)->not->toBeNull();
});

it('cascades question and option deletion when a questionnaire is force-deleted', function () {
    $q = Questionnaire::factory()->create();
    $question = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->count(3)->create();

    $q->forceDelete();

    expect(Question::withoutWorkspaceScope()->count())->toBe(0);
    expect(QuestionOption::withoutWorkspaceScope()->count())->toBe(0);
});

it('enforces uniqueness of (response_id, question_id) on answers', function () {
    $r = Response::factory()->create();
    $question = Question::factory()->forQuestionnaire($r->questionnaire)->create();

    ResponseAnswer::factory()->pair($r, $question)->create();

    expect(fn () => ResponseAnswer::factory()->pair($r, $question)->create())
        ->toThrow(\Illuminate\Database\QueryException::class);
});

it('computes max score from correct options on auto-gradable questions', function () {
    $q = Questionnaire::factory()->create();
    $question = Question::factory()->ofType(QuestionType::MultiChoice)->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($question)->correct(2)->create();
    QuestionOption::factory()->forQuestion($question)->correct(3)->create();
    QuestionOption::factory()->forQuestion($question)->create(); // wrong

    expect($question->maxScore())->toBe(5.0);
});

it('returns zero max score for non-auto-gradable types', function () {
    $q = Questionnaire::factory()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($q)->create();

    expect($textQ->maxScore())->toBe(0.0);
});

it('marks an anonymous response correctly', function () {
    $r = Response::factory()->create(['respondent_user_id' => null]);
    expect($r->isAnonymous())->toBeTrue();
});

it('computes percentage when score and max_score are set', function () {
    $r = Response::factory()->submitted()->create([
        'score' => 7,
        'max_score' => 10,
    ]);
    expect($r->percentage())->toBe(70.0);
});

it('returns null percentage when max_score is missing or zero', function () {
    $r = Response::factory()->create(['score' => 7, 'max_score' => null]);
    expect($r->percentage())->toBeNull();

    $r2 = Response::factory()->create(['score' => 0, 'max_score' => 0]);
    expect($r2->percentage())->toBeNull();
});

it('serializes JSON columns (settings, meta, branching, value) correctly', function () {
    $q = Questionnaire::factory()->create([
        'settings' => ['allow_anonymous' => true, 'time_limit_seconds' => 600],
    ]);
    expect($q->fresh()->settings)->toBe(['allow_anonymous' => true, 'time_limit_seconds' => 600]);

    $question = Question::factory()->forQuestionnaire($q)->create([
        'meta' => ['scale_min' => 1, 'scale_max' => 5],
        'branching' => [
            ['when' => ['answer' => 'no'], 'action' => ['type' => 'end']],
        ],
    ]);
    expect($question->fresh()->meta)->toBe(['scale_min' => 1, 'scale_max' => 5]);
    expect($question->fresh()->branching[0]['action']['type'])->toBe('end');

    $r = Response::factory()->forQuestionnaire($q)->create();
    $answer = ResponseAnswer::factory()->pair($r, $question)->create([
        'value' => ['option-a', 'option-b'],
    ]);
    expect($answer->fresh()->value)->toBe(['option-a', 'option-b']);
});

it('respects QuestionType helpers', function () {
    expect(QuestionType::SingleChoice->hasOptions())->toBeTrue();
    expect(QuestionType::ShortText->hasOptions())->toBeFalse();
    expect(QuestionType::MultiChoice->isMultiValue())->toBeTrue();
    expect(QuestionType::SingleChoice->isMultiValue())->toBeFalse();
    expect(QuestionType::SingleChoice->isAutoGradable())->toBeTrue();
    expect(QuestionType::ShortText->isAutoGradable())->toBeFalse();
    expect(QuestionType::ShortText->needsAiGrading())->toBeTrue();
    expect(QuestionType::SingleChoice->needsAiGrading())->toBeFalse();
});

it('the QuestionnaireKind enum has all four expected cases', function () {
    expect(QuestionnaireKind::cases())->toHaveCount(4);
    expect(QuestionnaireKind::Assessment->isGraded())->toBeTrue();
    expect(QuestionnaireKind::Survey->isGraded())->toBeFalse();
    expect(QuestionnaireKind::Poll->isLive())->toBeTrue();
});
