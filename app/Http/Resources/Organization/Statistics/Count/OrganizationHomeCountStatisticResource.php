<?php

namespace App\Http\Resources\Organization\Statistics\Count;



use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationResource;

class OrganizationHomeCountStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'teacher_count' => $this['teacher_count'] ?? 0,
            'student_count' => $this['student_count'] ?? 0,
            'parent_count' => $this['parent_count'] ?? 0,
        ];
    }
}
