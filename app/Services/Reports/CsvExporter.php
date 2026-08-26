<?php

namespace App\Services\Reports;

use App\Enums\ResponseStatus;
use App\Models\Questionnaire;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Streams a CSV with one row per submitted Response. Question titles
 * become column headers; answers are stringified deterministically
 * (arrays joined with " | ").
 */
class CsvExporter
{
    public function streamFor(Questionnaire $questionnaire): StreamedResponse
    {
        $questions = $questionnaire->questions()->orderBy('position')->get(['id', 'title']);
        $filename = preg_replace('/[^A-Za-z0-9_-]/', '-', $questionnaire->slug).'-responses.csv';

        return response()->streamDownload(function () use ($questionnaire, $questions) {
            $out = fopen('php://output', 'w');

            $header = ['response_id', 'submitted_at', 'respondent_email', 'score', 'max_score'];
            foreach ($questions as $q) {
                $header[] = $q->title;
            }
            fputcsv($out, $header);

            $questionnaire->responses()
                ->where('status', ResponseStatus::Submitted)
                ->with('answers')
                ->orderBy('submitted_at')
                ->chunk(200, function ($chunk) use ($out, $questions) {
                    foreach ($chunk as $r) {
                        $byQ = $r->answers->keyBy('question_id');

                        $row = [
                            $r->id,
                            optional($r->submitted_at)->toIso8601String(),
                            $r->respondent_email,
                            $r->score,
                            $r->max_score,
                        ];
                        foreach ($questions as $q) {
                            $a = $byQ->get($q->id);
                            $row[] = $a ? $this->stringify($a->value) : '';
                        }
                        fputcsv($out, $row);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'no-store',
        ]);
    }

    protected function stringify(mixed $value): string
    {
        if ($value === null) {
            return '';
        }
        if (is_array($value)) {
            return implode(' | ', array_map(fn ($v) => (string) $v, $value));
        }

        return (string) $value;
    }
}
