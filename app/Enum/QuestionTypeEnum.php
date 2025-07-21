<?php

namespace App\Enum;

enum QuestionTypeEnum: int
{
    case ARTICLE = 1;
    case MULIPLE_CHOICE = 2;
    case COMPLETE = 3;
    case CORRECTION = 4;
    case AUDIO = 5;

    public function label(): string
    {
        return match ($this) {
            self::ARTICLE => 'Article',
            self::MULIPLE_CHOICE => 'Multiple Choice',
            self::COMPLETE => 'Complete',
            self::CORRECTION => 'correction',
            self::AUDIO => 'Audio',
        };
    }
}
