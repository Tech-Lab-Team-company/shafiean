<?php

namespace App\Enum;

enum ExamStatusEnum: int
{
    case IN_ACTIVE = 0;
    case ACTIVE = 1;


    public function label(): string
    {
        return match ($this) {
            self::IN_ACTIVE => 'In Active',
            self::ACTIVE => 'Active',
        };
    }
}
