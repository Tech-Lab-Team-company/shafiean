<?php

namespace App\Http\Resources\Organization\Teacher\Statistics\Count;




use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationResource;

class TeacherStatisticCountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'lesson_count' => $this['lesson_count'] ?? 0,
            'student_count' => $this['student_count'] ?? 0,
            'group_count' => $this['group_count'] ?? 0,
        ];
    }
}
