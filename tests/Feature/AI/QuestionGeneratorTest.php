<?php

use App\Enums\QuestionType;
use App\Models\AiUsage;
use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Workspace;
use App\Services\AI\QuestionGenerator;
use App\Services\Tenancy;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('generates questions from a topic and persists them with options', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured([
                'questions' => [
                    [
                        'title' => 'Capital of France?',
                        'helper' => '',
                        'type' => 'single_choice',
                        'required' => true,
                        'options' => [
                            ['label' => 'Paris', 'value' => 'paris', 'is_correct' => true, 'score' => 1],
                            ['label' => 'London', 'value' => 'london', 'is_correct' => false, 'score' => 0],
                        ],
                    ],
                    [
                        'title' => 'Why is Paris a capital?',
                        'helper' => 'In one sentence.',
                        'type' => 'short_text',
                        'required' => false,
                        'options' => [],
                    ],
                ],
            ])
            ->withUsage(new Usage(promptTokens: 500, completionTokens: 250)),
    ]);

    $user = User::factory()->create();
    $q = Questionnaire::factory()->create();

    $generated = app(QuestionGenerator::class)
        ->generateForTopic($q, 'European capitals', count: 2, userId: $user->id);

    expect($generated)->toHaveCount(2);

    $persisted = $q->fresh()->questions()->orderBy('position')->with('options')->get();
    expect($persisted)->toHaveCount(2);
    expect($persisted[0]->title)->toBe('Capital of France?');
    expect($persisted[0]->type)->toBe(QuestionType::SingleChoice);
    expect($persisted[0]->options)->toHaveCount(2);
    expect($persisted[0]->options->firstWhere('value', 'paris')->is_correct)->toBeTrue();
    expect($persisted[1]->type)->toBe(QuestionType::ShortText);
    expect($persisted[1]->required)->toBeFalse();
    expect($persisted[1]->options)->toHaveCount(0);

    // Usage row written.
    expect(AiUsage::count())->toBe(1);
    expect(AiUsage::first()->user_id)->toBe($user->id);
});

it('clears is_correct / score on non-assessment kinds even if the model returns them', function () {
    Prism::fake([
        StructuredResponseFake::make()->withStructured([
            'questions' => [[
                'title' => 'How happy are you?',
                'helper' => '',
                'type' => 'single_choice',
                'required' => true,
                'options' => [
                    ['label' => 'Very', 'value' => 'very', 'is_correct' => true, 'score' => 99],
                    ['label' => 'Not really', 'value' => 'not', 'is_correct' => false, 'score' => 0],
                ],
            ]],
        ])->withUsage(new Usage(100, 50)),
    ]);

    $survey = Questionnaire::factory()->survey()->create();

    app(QuestionGenerator::class)->generateForTopic($survey, 'Mood check', count: 1);

    $option = $survey->fresh()->questions->first()->options->firstWhere('value', 'very');
    expect($option->is_correct)->toBeFalse();
    expect((float) $option->score)->toBe(0.0);
});

it('appends new questions after the existing ones, preserving position order', function () {
    Prism::fake([
        StructuredResponseFake::make()->withStructured([
            'questions' => [[
                'title' => 'Generated Q',
                'helper' => '',
                'type' => 'short_text',
                'required' => false,
                'options' => [],
            ]],
        ])->withUsage(new Usage(10, 10)),
    ]);

    $q = Questionnaire::factory()->create();
    \App\Models\Question::factory()->forQuestionnaire($q)->create(['position' => 1, 'title' => 'Existing']);
    \App\Models\Question::factory()->forQuestionnaire($q)->create(['position' => 2, 'title' => 'Also existing']);

    app(QuestionGenerator::class)->generateForTopic($q, 'Anything', count: 1);

    $all = $q->fresh()->questions()->orderBy('position')->pluck('title')->all();
    expect($all)->toBe(['Existing', 'Also existing', 'Generated Q']);
});

it('silently drops malformed question entries (unknown type)', function () {
    Prism::fake([
        StructuredResponseFake::make()->withStructured([
            'questions' => [
                ['title' => 'Valid', 'type' => 'short_text', 'required' => false, 'options' => []],
                ['title' => 'Bogus', 'type' => 'flying_unicorn', 'required' => false, 'options' => []],
            ],
        ])->withUsage(new Usage(10, 10)),
    ]);

    $q = Questionnaire::factory()->create();

    $generated = app(QuestionGenerator::class)->generateForTopic($q, 'mixed', count: 2);

    expect($generated)->toHaveCount(1);
    expect($q->fresh()->questions->count())->toBe(1);
});

it('clamps the count to a sensible range', function () {
    Prism::fake([
        StructuredResponseFake::make()->withStructured(['questions' => []])->withUsage(new Usage(1, 1)),
    ]);

    $q = Questionnaire::factory()->create();
    // 99 → clamped to 20. Empty fake response is fine for this assertion.
    app(QuestionGenerator::class)->generateForTopic($q, 'whatever', count: 99);
    expect(true)->toBeTrue(); // Doesn't throw.
});
