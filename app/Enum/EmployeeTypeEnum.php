<?php

namespace App\Enum;

enum EmployeeTypeEnum: int
{
    case EMPLOYEE = 0;
    case TEACHER = 1;


    public function label(): string
    {
        return match ($this) {
            self::EMPLOYEE => 'Employee',
            self::TEACHER => 'Teacher',
        };
    }
}
