<?php

namespace App\Services\Reports;

use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Support\Collection;

/**
 * Computes the numbers the analytics page renders. Stays pure — no UI,
 * no caching here; cache at the call site if needed.
 *
 * Returned shape is JSON-friendly so it works for both Blade and a
 * future API endpoint.
 */
class Aggregator
{
    public function summary(Questionnaire $q): array
    {
        $submitted = $q->responses()->where('status', ResponseStatus::Submitted)->count();
        $inProgress = $q->responses()->where('status', ResponseStatus::InProgress)->count();
        $total = $submitted + $inProgress;

        return [
            'total' => $total,
            'submitted' => $submitted,
            'in_progress' => $inProgress,
            'completion_rate' => $total > 0 ? round(($submitted / $total) * 100, 1) : 0.0,
            'average_score_pct' => $this->averageScorePct($q),
            'first_submitted_at' => optional($q->responses()->where('status', ResponseStatus::Submitted)->min('submitted_at'))->toString(),
            'last_submitted_at' => optional($q->responses()->where('status', ResponseStatus::Submitted)->max('submitted_at'))->toString(),
        ];
    }

    public function averageScorePct(Questionnaire $q): ?float
    {
        if (! $q->kind->isGraded()) {
            return null;
        }
        $rows = $q->responses()
            ->where('status', ResponseStatus::Submitted)
            ->whereNotNull('score')
            ->whereNotNull('max_score')
            ->where('max_score', '>', 0)
            ->get(['score', 'max_score']);

        if ($rows->isEmpty()) {
            return null;
        }
        $pcts = $rows->map(fn ($r) => ((float) $r->score / (float) $r->max_score) * 100);
        return round($pcts->avg(), 1);
    }

    /**
     * Score distribution as 10-bucket histogram (0-9, 10-19, ..., 90-100).
     *
     * @return array<int, int>  bucket-index → count
     */
    public function scoreHistogram(Questionnaire $q): array
    {
        if (! $q->kind->isGraded()) {
            return [];
        }
        $buckets = array_fill(0, 10, 0);
        $q->responses()
            ->where('status', ResponseStatus::Submitted)
            ->whereNotNull('score')
            ->whereNotNull('max_score')
            ->where('max_score', '>', 0)
            ->get(['score', 'max_score'])
            ->each(function ($r) use (&$buckets) {
                $pct = ((float) $r->score / (float) $r->max_score) * 100;
                $idx = min(9, (int) floor($pct / 10));
                $buckets[$idx]++;
            });
        return $buckets;
    }

    /**
     * NPS = % promoters (9-10) − % detractors (0-6) for the first NPS
     * question we find (returns null if none / no data).
     */
    public function nps(Questionnaire $q): ?array
    {
        $npsQuestion = $q->questions()->where('type', QuestionType::Nps->value)->orderBy('position')->first();
        if (! $npsQuestion) {
            return null;
        }

        $values = $npsQuestion->answers()
            ->whereHas('response', fn ($r) => $r->where('status', ResponseStatus::Submitted))
            ->get('value')
            ->map(fn ($a) => (int) (is_array($a->value) ? ($a->value[0] ?? 0) : $a->value));

        if ($values->isEmpty()) {
            return null;
        }

        $promoters = $values->filter(fn ($v) => $v >= 9)->count();
        $detractors = $values->filter(fn ($v) => $v <= 6)->count();
        $passives = $values->count() - $promoters - $detractors;
        $score = (int) round((($promoters - $detractors) / $values->count()) * 100);

        return [
            'question_id' => $npsQuestion->id,
            'question_title' => $npsQuestion->title,
            'score' => $score,
            'promoters' => $promoters,
            'passives' => $passives,
            'detractors' => $detractors,
            'sample' => $values->count(),
        ];
    }

    /**
     * Per-question breakdown. For choice questions: vote tallies. For
     * scalar (likert/nps/rating): histogram. For text: a sample of N answers.
     *
     * @return array<int, array<string, mixed>>  one entry per question
     */
    public function perQuestion(Questionnaire $q, int $textSampleLimit = 10): array
    {
        $out = [];

        foreach ($q->questions()->with('options')->orderBy('position')->get() as $question) {
            $base = [
                'id' => $question->id,
                'title' => $question->title,
                'type' => $question->type->value,
                'type_label' => $question->type->label(),
                'answer_count' => 0,
            ];

            $answers = $question->answers()
                ->whereHas('response', fn ($r) => $r->where('status', ResponseStatus::Submitted))
                ->get('value');

            $base['answer_count'] = $answers->count();

            if ($question->type->hasOptions()) {
                $base['tallies'] = $this->talliesForChoice($question, $answers);
            } elseif (in_array($question->type, [QuestionType::Likert, QuestionType::Nps, QuestionType::Rating], true)) {
                $base['histogram'] = $this->scalarHistogram($question, $answers);
            } elseif (in_array($question->type, [QuestionType::ShortText, QuestionType::LongText], true)) {
                $base['samples'] = $answers
                    ->map(fn ($a) => (string) (is_array($a->value) ? ($a->value[0] ?? '') : $a->value))
                    ->filter(fn ($s) => trim($s) !== '')
                    ->take($textSampleLimit)
                    ->values()
                    ->all();
            }

            $out[] = $base;
        }

        return $out;
    }

    protected function talliesForChoice(Question $question, Collection $answers): array
    {
        $byValue = $question->options->keyBy('value');
        $counts = [];
        $total = 0;

        foreach ($answers as $a) {
            $values = is_array($a->value) ? $a->value : [$a->value];
            foreach ($values as $v) {
                if ($v === null || $v === '') {
                    continue;
                }
                $counts[$v] = ($counts[$v] ?? 0) + 1;
                $total++;
            }
        }

        $rows = [];
        foreach ($question->options as $opt) {
            $count = $counts[$opt->value] ?? 0;
            $rows[] = [
                'label' => $opt->label,
                'value' => $opt->value,
                'count' => $count,
                'percent' => $total > 0 ? round(($count / $total) * 100, 1) : 0.0,
                'is_correct' => (bool) $opt->is_correct,
            ];
        }
        return $rows;
    }

    protected function scalarHistogram(Question $question, Collection $answers): array
    {
        $min = (int) ($question->meta['scale_min'] ?? ($question->type === QuestionType::Nps ? 0 : 1));
        $max = (int) ($question->meta['scale_max'] ?? ($question->type === QuestionType::Nps ? 10 : 5));
        $rows = [];
        for ($n = $min; $n <= $max; $n++) {
            $rows[$n] = 0;
        }
        foreach ($answers as $a) {
            $v = (int) (is_array($a->value) ? ($a->value[0] ?? 0) : $a->value);
            if (isset($rows[$v])) {
                $rows[$v]++;
            }
        }
        return $rows;
    }
}
