<?php

namespace App\Http\Resources\Organization\AttendenceReport;

use App\Enum\ReportTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendenceReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
            "id" => $this->id,
            "date" => $this->date ?? '',
            "hijri_date" => $this->hijri_date ?? '',
            "notes" => $this->notes ?? '',
            "is_absent" => $this->is_absent ?? false,          
            "teacher_id" => $this->teacher_id
        ];
    }
}
