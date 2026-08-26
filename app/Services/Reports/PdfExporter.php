<?php

namespace App\Services\Reports;

use App\Models\Questionnaire;

class PdfExporter
{
    public function __construct(protected Aggregator $aggregator) {}

    public function make(Questionnaire $questionnaire): string
    {
        $summary = $this->aggregator->summary($questionnaire);
        $lines = [
            $questionnaire->title,
            $questionnaire->kind->label().' report',
            '',
            'Total responses: '.$summary['total'],
            'Submitted: '.$summary['submitted'],
            'In progress: '.$summary['in_progress'],
            'Completion rate: '.$summary['completion_rate'].'%',
        ];

        if ($summary['average_score_pct'] !== null) {
            $lines[] = 'Average score: '.$summary['average_score_pct'].'%';
        }

        $lines[] = '';
        $lines[] = 'Questions';
        foreach ($this->aggregator->perQuestion($questionnaire) as $index => $question) {
            $lines[] = ($index + 1).'. '.$question['title'].' ('.$question['answer_count'].' answers)';
        }

        $stream = "BT\n/F1 12 Tf\n50 760 Td\n16 TL\n";
        foreach (array_slice($lines, 0, 43) as $line) {
            $stream .= '('.$this->escape($line).") Tj\nT*\n";
        }
        $stream .= "ET\n";

        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
            '<< /Length '.strlen($stream)." >>\nstream\n{$stream}endstream",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $number = $index + 1;
            $pdf .= "{$number} 0 obj\n{$object}\nendobj\n";
        }

        $xref = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";
        foreach (array_slice($offsets, 1) as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }

        return $pdf."trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF\n";
    }

    private function escape(mixed $value): string
    {
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', (string) $value) ?: '';

        return str_replace(['\\', '(', ')', "\r", "\n"], ['\\\\', '\\(', '\\)', ' ', ' '], $ascii);
    }
}
