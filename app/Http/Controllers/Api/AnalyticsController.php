<?php

namespace App\Http\Controllers\Api;

use App\Models\Questionnaire;
use App\Services\Reports\Aggregator;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends ApiController
{
    public function show(Questionnaire $questionnaire, Aggregator $aggregator): JsonResponse
    {
        return response()->json(['data' => [
            'summary' => $aggregator->summary($questionnaire),
            'score_histogram' => $aggregator->scoreHistogram($questionnaire),
            'nps' => $aggregator->nps($questionnaire),
            'questions' => $aggregator->perQuestion($questionnaire),
        ]]);
    }
}
