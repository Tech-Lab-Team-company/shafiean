<?php

namespace App\Http\Resources\Organization\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $startDate = $this->start_date ? Carbon::parse($this->start_date) : null;
        $endDate = $this->end_date ? Carbon::parse($this->end_date) : null;
        $duration = "0 يوم";
        if ($startDate && $endDate) {
            $diff = $startDate->diff($endDate);
            $months = $diff->m;
            $days = $diff->d;
            if ($months > 0) {
                $duration = "{$months} شهر" . ($months > 1 ? "" : "");
            }
            elseif ($days > 0) {
                $duration = "{$days} يوم" . ($days > 1 ? "" : "");
            }
        }
        $status = $endDate && Carbon::today()->gt($endDate) ? 0 : 1;
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'start_date' => $this->start_date ?? "",
            'end_date' => $this->end_date ?? "",
            'duration' => $duration ?? "",
            'subscription_count' => 10 ?? "",
            'status'=>$status
        ];
    }
}
