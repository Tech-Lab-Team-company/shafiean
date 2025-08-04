<?php

namespace App\Http\Resources\Organization\AttendenceReport;

use App\Enum\ReportTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendenceReportDetailsResource extends AttendenceReportResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        
    }
}
