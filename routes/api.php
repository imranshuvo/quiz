<?php

use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionnaireController;
use App\Http\Controllers\Api\QuestionOptionController;
use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Api\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'workspace.api', 'throttle:api'])
    ->group(function () {
        Route::middleware('abilities:workspace:read')->get('workspace', [WorkspaceController::class, 'show']);

        Route::middleware('abilities:content:read')->group(function () {
            Route::get('questionnaires', [QuestionnaireController::class, 'index']);
            Route::get('questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);
            Route::get('questionnaires/{questionnaire}/responses', [ResponseController::class, 'index']);
            Route::get('questionnaires/{questionnaire}/responses/{response}', [ResponseController::class, 'show']);
            Route::get('questionnaires/{questionnaire}/analytics', [AnalyticsController::class, 'show']);
        });

        Route::middleware('abilities:content:write')->group(function () {
            Route::post('questionnaires', [QuestionnaireController::class, 'store']);
            Route::patch('questionnaires/{questionnaire}', [QuestionnaireController::class, 'update']);
            Route::delete('questionnaires/{questionnaire}', [QuestionnaireController::class, 'destroy']);
            Route::post('questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);
            Route::patch('questionnaires/{questionnaire}/questions/{question}', [QuestionController::class, 'update']);
            Route::delete('questionnaires/{questionnaire}/questions/{question}', [QuestionController::class, 'destroy']);
            Route::post('questionnaires/{questionnaire}/questions/{question}/options', [QuestionOptionController::class, 'store']);
            Route::patch('questionnaires/{questionnaire}/questions/{question}/options/{option}', [QuestionOptionController::class, 'update']);
            Route::delete('questionnaires/{questionnaire}/questions/{question}/options/{option}', [QuestionOptionController::class, 'destroy']);
        });
    });
