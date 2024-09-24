<?php

namespace App\Enum;

enum UserTypeEnum: int
{
    case STUDENT = 0;
    case PARENT = 1;


    public function label(): string
    {
        return match ($this) {
            self::STUDENT => 'Student',
            self::PARENT => 'Parent',
        };
    }
}
