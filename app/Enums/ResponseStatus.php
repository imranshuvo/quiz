<?php

namespace App\Enums;

enum ResponseStatus: string
{
    case InProgress = 'in_progress';
    case Submitted = 'submitted';
    case Abandoned = 'abandoned';

    public function label(): string
    {
        return match ($this) {
            self::InProgress => 'In progress',
            self::Submitted => 'Submitted',
            self::Abandoned => 'Abandoned',
        };
    }
}
