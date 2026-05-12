<?php

namespace App\Enums;

enum QuestionnaireKind: string
{
    case Assessment = 'assessment';
    case Survey = 'survey';
    case Poll = 'poll';
    case Form = 'form';

    public function label(): string
    {
        return match ($this) {
            self::Assessment => 'Quiz / Assessment',
            self::Survey => 'Survey',
            self::Poll => 'Live poll',
            self::Form => 'Form',
        };
    }

    public function isGraded(): bool
    {
        return $this === self::Assessment;
    }

    public function isLive(): bool
    {
        return $this === self::Poll;
    }
}
