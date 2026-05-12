<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default provider + model
    |--------------------------------------------------------------------------
    |
    | Used when a task-specific override below isn't set. The provider must
    | match one of the names from Prism\Prism\Enums\Provider — the Brain
    | wrapper resolves it via Provider::from().
    |
    */
    'default_provider' => env('PRISM_DEFAULT_PROVIDER', 'anthropic'),
    'default_model' => env('PRISM_DEFAULT_MODEL', 'claude-sonnet-4-6'),

    /*
    |--------------------------------------------------------------------------
    | Per-task model routing
    |--------------------------------------------------------------------------
    |
    | Each AI feature can pick its own provider+model so we A/B and tune
    | independently. Leave a key blank to fall back to the defaults above.
    |
    */
    'tasks' => [
        'generate_questions' => [
            'provider' => env('AI_GEN_PROVIDER'),
            'model' => env('AI_GEN_MODEL'),
        ],
        'grade_answer' => [
            'provider' => env('AI_GRADE_PROVIDER'),
            'model' => env('AI_GRADE_MODEL'),
        ],
        'insights' => [
            'provider' => env('AI_INSIGHTS_PROVIDER'),
            'model' => env('AI_INSIGHTS_MODEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cost estimates (cents per 1M tokens)
    |--------------------------------------------------------------------------
    |
    | Rough public list-price estimates used to fill ai_usages.cost_cents
    | so the Filament admin can show per-workspace AI spend trends without
    | round-tripping to billing. Update as vendor pricing changes.
    |
    */
    'cost_per_million_tokens_cents' => [
        'anthropic' => ['input' => 300, 'output' => 1500],     // Sonnet 4.6 ballpark
        'openai' => ['input' => 250, 'output' => 1000],        // gpt-4o ballpark
        'gemini' => ['input' => 100, 'output' => 400],         // 2.0 flash ballpark
        'ollama' => ['input' => 0, 'output' => 0],             // self-hosted
    ],
];
