<?php

namespace App\Enums;

enum AiUsageKind: string
{
    case GenerateQuestions = 'generate_questions';
    case GradeAnswer = 'grade_answer';
    case Insights = 'insights';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::GenerateQuestions => 'Question generation',
            self::GradeAnswer => 'Open-ended grading',
            self::Insights => 'Response insights',
            self::Other => 'Other',
        };
    }
}
