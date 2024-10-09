<?php

namespace App\Enum;

enum MaritalStatusEnum: int
{
    case SINGLE = 0;
    case MARRIED = 1;


    public function label(): string
    {
        return match ($this) {
            self::SINGLE => 'Single',
            self::MARRIED => 'Married',
        };
    }
}
