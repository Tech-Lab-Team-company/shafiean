<?php

namespace App\Http\Resources\Admin\Statistics\Student;



use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticLatestStudentGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
        ];
    }
}
