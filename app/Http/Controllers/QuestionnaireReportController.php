<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Services\Reports\PdfExporter;
use App\Services\Tenancy;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class QuestionnaireReportController extends Controller
{
    public function pdf(Questionnaire $questionnaire, PdfExporter $exporter, Tenancy $tenancy): Response
    {
        $workspace = $tenancy->current();
        abort_unless($workspace && $questionnaire->workspace_id === $workspace->id, 404);

        return response($exporter->make($questionnaire), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.Str::slug($questionnaire->title).'-report.pdf"',
        ]);
    }
}
