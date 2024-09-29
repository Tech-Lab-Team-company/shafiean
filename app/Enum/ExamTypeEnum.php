<?php

namespace App\Enum;

enum ExamTypeEnum: int
{
    case AUDIO = 1;
    case MULIPLE_CHOICE = 2;
    case MATCHING = 3;
    case CORRECTION = 4;

    public function label(): string
    {
        return match ($this) {
            self::AUDIO => 'Audio',
            self::MULIPLE_CHOICE => 'Multiple Choice',
            self::MATCHING => 'Matching',
            self::CORRECTION => 'correction',
        };
    }
}
