<?php

namespace App\Http\Resources\Admin\Statistics\Student;


use Illuminate\Http\Resources\Json\JsonResource;

class StatisticLatestStudentDisabilityTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
        ];
    }
}
