<?php

use App\Enums\QuestionType;
use App\Models\AiUsage;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\AI\Grader;
use App\Services\Tenancy;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('skips grading for non-assessment kinds', function () {
    $survey = Questionnaire::factory()->survey()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($survey)->create();
    $r = Response::factory()->forQuestionnaire($survey)->submitted()->create();
    ResponseAnswer::factory()->pair($r, $textQ)->create(['value' => ['something']]);

    app(Grader::class)->gradeResponse($r->fresh());

    expect(AiUsage::count())->toBe(0);
    expect($r->fresh()->answers->first()->is_correct)->toBeNull();
});

it('skips when the assessment has no open-ended answers', function () {
    $a = Questionnaire::factory()->create();
    $choice = Question::factory()->forQuestionnaire($a)->create(['type' => QuestionType::SingleChoice]);
    QuestionOption::factory()->forQuestion($choice)->correct(1)->create(['value' => 'a']);

    $r = Response::factory()->forQuestionnaire($a)->submitted()->create(['score' => 1, 'max_score' => 1]);
    ResponseAnswer::factory()->pair($r, $choice)->create(['value' => ['a'], 'is_correct' => true, 'score' => 1]);

    app(Grader::class)->gradeResponse($r->fresh());

    expect(AiUsage::count())->toBe(0);
    expect((float) $r->fresh()->score)->toBe(1.0);
});

it('grades an open-ended answer and bumps Response.score / max_score', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured(['score' => 0.8, 'feedback' => 'Good but missed the dark reactions.', 'is_correct' => true])
            ->withUsage(new Usage(200, 80)),
    ]);

    $a = Questionnaire::factory()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($a)->create([
        'meta' => ['max_points' => 2, 'rubric' => 'Should mention light + dark reactions.'],
    ]);
    $r = Response::factory()->forQuestionnaire($a)->submitted()->create([
        'score' => 0, 'max_score' => 0,
    ]);
    ResponseAnswer::factory()->pair($r, $textQ)->create(['value' => ['Photosynthesis uses light…']]);

    app(Grader::class)->gradeResponse($r->fresh());

    $answer = $r->fresh()->answers->first();
    expect((float) $answer->score)->toBe(0.8);
    expect($answer->is_correct)->toBeTrue();

    // Response totals include the open-ended max even though Question::maxScore() is 0 for text.
    expect((float) $r->fresh()->score)->toBe(0.8);
    expect((float) $r->fresh()->max_score)->toBe(2.0);

    // One ledger row for one AI call.
    expect(AiUsage::count())->toBe(1);
});

it('clamps an AI-awarded score above max_points', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured(['score' => 999, 'feedback' => 'overshoot'])
            ->withUsage(new Usage(10, 10)),
    ]);

    $a = Questionnaire::factory()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($a)->create(['meta' => ['max_points' => 3]]);
    $r = Response::factory()->forQuestionnaire($a)->submitted()->create(['score' => 0, 'max_score' => 0]);
    ResponseAnswer::factory()->pair($r, $textQ)->create(['value' => ['anything']]);

    app(Grader::class)->gradeResponse($r->fresh());

    expect((float) $r->fresh()->answers->first()->score)->toBe(3.0);
});

it('handles a blank answer with score 0 and no AI call', function () {
    $a = Questionnaire::factory()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($a)->create(['meta' => ['max_points' => 2]]);
    $r = Response::factory()->forQuestionnaire($a)->submitted()->create(['score' => 0, 'max_score' => 0]);
    ResponseAnswer::factory()->pair($r, $textQ)->create(['value' => ['']]);

    // No Prism::fake — would error if a call were made.
    app(Grader::class)->gradeResponse($r->fresh());

    expect((float) $r->fresh()->answers->first()->score)->toBe(0.0);
    expect($r->fresh()->answers->first()->is_correct)->toBeFalse();
    expect(AiUsage::count())->toBe(0);
});
