<?php

namespace App\Enum;

use App\Trait\HasMetadata;

enum ReportTypeEnum:int
{
    use HasMetadata;
    case QURAAN = 1;
    case ATTENDENCE = 2;
    public function getMetadata(): array
    {
        return match ($this) {
            self::QURAAN => [
                'label' => 'Quraan',
            ],
            self::ATTENDENCE => [
                'label' => 'Attendence Report',
            ],
            default => [
                'label' => '',
            ]
        };
    }
}
