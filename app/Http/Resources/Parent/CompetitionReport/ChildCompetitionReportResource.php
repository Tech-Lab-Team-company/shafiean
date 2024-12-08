<?php

namespace App\Http\Resources\Parent\CompetitionReport;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildCompetitionReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $startDate = Carbon::parse($this->start_date ?? '');
        $endDate = Carbon::parse($this->end_date ?? '');
        $duration = '0';

        $diff = $startDate->diff($endDate);
        $months = $diff->m;
        $days = $diff->d;
        $arabicNumbers = [
            1 => '١',
            2 => '٢',
            3 => '٣',
            4 => '٤',
            5 => '٥',
            6 => '٦',
            7 => '٧',
            8 => '٨',
            9 => '٩',
            10 => '١٠',
            11 => '١١',
            12 => '١٢',
        ];

        if ($months > 0) {
            $arabicMonths = $this->convertToArabicNumbers($months, $arabicNumbers);
            $duration = "{$arabicMonths} شهر";
        } elseif ($days > 0) {
            $arabicDays = $this->convertToArabicNumbers($days, $arabicNumbers);
            $duration = "{$arabicDays} يوم";
        }


        $status = $endDate && Carbon::today()->gt($endDate) ? 0 : 1;
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'start_date' => $this->start_date ?? "",
            'end_date' => $this->end_date ?? "",
            'image' => $this->image_link ?? "",
            'duration' => $duration ?? "",
            'status' => $status
        ];
    }
    function convertToArabicNumbers($number, $mapping)
    {
        return strtr((string)$number, $mapping);
    }
}
