<?php

namespace App\Enum;

use App\Trait\HasMetadata;

enum ReportTypeEnum:int
{
    use HasMetadata;
    case QURAAN = 1;

    public function getMetadata(): array
    {
        return match ($this) {
            self::QURAAN => [
                'label' => 'Quraan',
            ],
            default => [
                'label' => '',
            ]
        };
    }
}
