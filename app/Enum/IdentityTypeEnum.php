<?php

namespace App\Enum;

enum IdentityTypeEnum: int
{
    case NATIONAL = 0;
    case PASSPORT = 1;
    case ID =2;


    public function label(): string
    {
        return match ($this) {
            self::NATIONAL => 'National',
            self::PASSPORT => 'Passport',
            self::ID => 'ID',
        };
    }
}
