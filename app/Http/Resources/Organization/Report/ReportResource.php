<?php

namespace App\Http\Resources\Organization\Report;

use App\Enum\ReportTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "degree" => $this->degree ?? 0,
            "report_type" => $this->type,
            "report_type_title" => ReportTypeEnum::from($this->type)->label(),
            "date" => $this->date ?? '',
            "hijri_date" => $this->hijri_date ?? '',
            "notes" => $this->notes ?? ''
        ];
    }
}
