<?php

namespace App\Enums;

enum QuestionnaireStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Archived => 'Archived',
        };
    }

    public function isOpenForResponses(): bool
    {
        return $this === self::Published;
    }
}
