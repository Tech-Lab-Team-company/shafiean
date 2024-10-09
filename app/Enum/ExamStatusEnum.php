<?php

namespace App\Enum;

enum ExamStatusEnum: int
{
    case PENDING = 0;
    case ACTIVE = 1;


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::ACTIVE => 'Active',
        };
    }
}
