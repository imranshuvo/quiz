<?php

namespace App\Enums;

enum QuestionType: string
{
    case SingleChoice = 'single_choice';
    case MultiChoice = 'multi_choice';
    case Likert = 'likert';
    case Nps = 'nps';
    case ShortText = 'short_text';
    case LongText = 'long_text';
    case Rating = 'rating';
    case Date = 'date';
    case Ranking = 'ranking';
    case File = 'file';

    public function label(): string
    {
        return match ($this) {
            self::SingleChoice => 'Single choice',
            self::MultiChoice => 'Multiple choice',
            self::Likert => 'Likert scale',
            self::Nps => 'NPS (0–10)',
            self::ShortText => 'Short text',
            self::LongText => 'Long text',
            self::Rating => 'Rating (stars)',
            self::Date => 'Date',
            self::Ranking => 'Ranking',
            self::File => 'File upload',
        };
    }

    /** Whether this question type stores answer choices in question_options. */
    public function hasOptions(): bool
    {
        return in_array($this, [
            self::SingleChoice,
            self::MultiChoice,
            self::Ranking,
        ], true);
    }

    /** Whether multiple values can be selected/submitted as the answer. */
    public function isMultiValue(): bool
    {
        return in_array($this, [
            self::MultiChoice,
            self::Ranking,
        ], true);
    }

    /** Whether this type can be auto-graded (without AI). */
    public function isAutoGradable(): bool
    {
        return in_array($this, [
            self::SingleChoice,
            self::MultiChoice,
        ], true);
    }

    /** Whether this type needs the AI grader (open-ended). */
    public function needsAiGrading(): bool
    {
        return in_array($this, [
            self::ShortText,
            self::LongText,
        ], true);
    }
}
