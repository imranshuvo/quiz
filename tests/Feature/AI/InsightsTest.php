<?php

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\AI\Insights;
use App\Services\Tenancy;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('returns null when there are no open-ended answers', function () {
    $q = Questionnaire::factory()->survey()->create();

    $result = app(Insights::class)->analyzeQuestionnaire($q);

    expect($result)->toBeNull();
});

it('summarizes text answers and persists insights on the questionnaire', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured([
                'themes' => [
                    ['label' => 'Slow checkout', 'supporting_quote' => 'Checkout was painfully slow.'],
                    ['label' => 'Great support', 'supporting_quote' => 'Support team was super helpful.'],
                ],
                'sentiment' => 'mixed',
                'summary' => 'Customers love support but find checkout slow.',
            ])
            ->withUsage(new Usage(800, 200)),
    ]);

    $q = Questionnaire::factory()->survey()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($q)->create();

    $r1 = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r1, $textQ)->create(['value' => ['Checkout was painfully slow.']]);

    $r2 = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($r2, $textQ)->create(['value' => ['Support team was super helpful.']]);

    $insights = app(Insights::class)->analyzeQuestionnaire($q);

    expect($insights)->not->toBeNull();
    expect($insights['sentiment'])->toBe('mixed');
    expect($insights['themes'])->toHaveCount(2);
    expect($insights['summary'])->toContain('Customers love support');

    // Persisted onto questionnaire.settings.insights
    $fresh = $q->fresh();
    expect($fresh->settings['insights']['sentiment'])->toBe('mixed');
    expect($fresh->settings['insights']['themes'])->toHaveCount(2);
});

it('ignores in-progress responses when sampling', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured(['themes' => [], 'sentiment' => 'positive', 'summary' => 'All good.'])
            ->withUsage(new Usage(100, 50)),
    ]);

    $q = Questionnaire::factory()->survey()->create();
    $textQ = Question::factory()->shortText()->forQuestionnaire($q)->create();

    $submitted = Response::factory()->forQuestionnaire($q)->submitted()->create();
    ResponseAnswer::factory()->pair($submitted, $textQ)->create(['value' => ['Submitted answer.']]);

    $inProgress = Response::factory()->forQuestionnaire($q)->create(); // status defaults to in_progress
    ResponseAnswer::factory()->pair($inProgress, $textQ)->create(['value' => ['Half answer.']]);

    $result = app(Insights::class)->analyzeQuestionnaire($q);

    expect($result['summary'])->toBe('All good.');
});
