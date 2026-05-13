<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Services\Reports\CsvExporter;
use App\Services\Tenancy;
use Symfony\Component\HttpFoundation\StreamedResponse;

class QuestionnaireExportController extends Controller
{
    public function csv(Questionnaire $questionnaire, CsvExporter $exporter, Tenancy $tenancy): StreamedResponse
    {
        $current = $tenancy->current();
        abort_unless($current && $questionnaire->workspace_id === $current->id, 404);
        abort_unless(auth()->user()->roleIn($current)?->canEditContent(), 403);

        return $exporter->streamFor($questionnaire);
    }
}
