<?php

namespace App\Http\Controllers;

use App\Enums\QuestionType;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Services\Tenancy;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ResponseFileController extends Controller
{
    public function download(
        Questionnaire $questionnaire,
        Response $response,
        ResponseAnswer $answer,
        Tenancy $tenancy,
    ): StreamedResponse {
        $workspace = $tenancy->current();
        abort_unless($workspace && $questionnaire->workspace_id === $workspace->id, 404);
        abort_unless($response->questionnaire_id === $questionnaire->id, 404);
        abort_unless($answer->response_id === $response->id && $answer->question?->type === QuestionType::File, 404);

        $file = is_array($answer->value) ? ($answer->value[0] ?? null) : null;
        abort_unless(is_array($file) && isset($file['path']) && Storage::disk('local')->exists($file['path']), 404);

        return Storage::disk('local')->download($file['path'], $file['name'] ?? basename($file['path']));
    }
}
