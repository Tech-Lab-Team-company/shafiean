<?php

namespace App\Enum;

enum DegreeTypeEnum: int
{
    case PERCENTAGE = 1;
    case GRADE = 2;


    public function label(): string
    {
        return match ($this) {
            self::PERCENTAGE => 'Percentage',
            self::GRADE => 'Grade',
        };
    }
}
