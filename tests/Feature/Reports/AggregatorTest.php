<?php

use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Reports\Aggregator;
use App\Services\Tenancy;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
    $this->agg = app(Aggregator::class);
});

it('summary computes counts and completion rate', function () {
    $q = Questionnaire::factory()->create();
    Response::factory()->count(3)->forQuestionnaire($q)->submitted()->create();
    Response::factory()->count(1)->forQuestionnaire($q)->create(); // in_progress

    $s = $this->agg->summary($q);
    expect($s['submitted'])->toBe(3);
    expect($s['in_progress'])->toBe(1);
    expect($s['total'])->toBe(4);
    expect($s['completion_rate'])->toBe(75.0);
});

it('average score percent is null for non-graded kinds', function () {
    $q = Questionnaire::factory()->survey()->create();
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 5, 'max_score' => 10]);

    expect($this->agg->averageScorePct($q))->toBeNull();
});

it('average score percent averages submitted graded responses', function () {
    $q = Questionnaire::factory()->create(); // assessment
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 5, 'max_score' => 10]);   // 50%
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 9, 'max_score' => 10]);   // 90%
    Response::factory()->forQuestionnaire($q)->create(['score' => 0, 'max_score' => 10]); // in_progress, ignored

    expect($this->agg->averageScorePct($q))->toBe(70.0);
});

it('score histogram buckets percentages 0-100 into 10 bins', function () {
    $q = Questionnaire::factory()->create();
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 5, 'max_score' => 100]);   // bin 0  (5%)
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 55, 'max_score' => 100]);  // bin 5  (55%)
    Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 100, 'max_score' => 100]); // bin 9  (100% → clamped)

    $h = $this->agg->scoreHistogram($q);
    expect($h[0])->toBe(1);
    expect($h[5])->toBe(1);
    expect($h[9])->toBe(1);
    expect(array_sum($h))->toBe(3);
});

it('NPS computes promoters minus detractors percentage', function () {
    $q = Questionnaire::factory()->survey()->create();
    $npsQ = Question::factory()->ofType(QuestionType::Nps)->forQuestionnaire($q)->create(['position' => 1]);

    foreach ([10, 9, 8, 7, 6, 0] as $score) {  // 2 promoters, 2 passives, 2 detractors
        $r = Response::factory()->forQuestionnaire($q)->submitted()->create();
        ResponseAnswer::factory()->pair($r, $npsQ)->create(['value' => [$score]]);
    }

    $nps = $this->agg->nps($q);
    expect($nps['promoters'])->toBe(2);
    expect($nps['passives'])->toBe(2);
    expect($nps['detractors'])->toBe(2);
    expect($nps['sample'])->toBe(6);
    expect($nps['score'])->toBe(0);
});

it('NPS returns null when no NPS question exists', function () {
    $q = Questionnaire::factory()->survey()->create();
    Question::factory()->shortText()->forQuestionnaire($q)->create();

    expect($this->agg->nps($q))->toBeNull();
});

it('per-question tallies for choice questions count submitted votes only', function () {
    $q = Questionnaire::factory()->create();
    $cq = Question::factory()->forQuestionnaire($q)->create();
    QuestionOption::factory()->forQuestion($cq)->create(['value' => 'a', 'label' => 'A']);
    QuestionOption::factory()->forQuestion($cq)->create(['value' => 'b', 'label' => 'B']);

    $r1 = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r1, $cq)->create(['value' => ['a']]);
    $r2 = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r2, $cq)->create(['value' => ['a']]);
    $r3 = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r3, $cq)->create(['value' => ['b']]);
    // in-progress excluded
    $rip = Response::factory()->forQuestionnaire($q)->create();
    ResponseAnswer::factory()->pair($rip, $cq)->create(['value' => ['b']]);

    $rows = $this->agg->perQuestion($q);
    $row = $rows[0];
    expect($row['answer_count'])->toBe(3);
    $tA = collect($row['tallies'])->firstWhere('value', 'a');
    $tB = collect($row['tallies'])->firstWhere('value', 'b');
    expect($tA['count'])->toBe(2);
    expect($tA['percent'])->toBe(66.7);
    expect($tB['count'])->toBe(1);
});

it('per-question samples text answers (capped)', function () {
    $q = Questionnaire::factory()->create();
    $tq = Question::factory()->shortText()->forQuestionnaire($q)->create();

    foreach (['hello', 'world', 'foo', 'bar', 'baz'] as $txt) {
        $r = Response::factory()->forQuestionnaire($q)->submitted()->create();
        ResponseAnswer::factory()->pair($r, $tq)->create(['value' => [$txt]]);
    }

    $row = $this->agg->perQuestion($q, textSampleLimit: 3)[0];
    expect($row['samples'])->toHaveCount(3);
});
