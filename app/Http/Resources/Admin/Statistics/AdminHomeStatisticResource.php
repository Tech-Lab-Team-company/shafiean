<?php

namespace App\Http\Resources\Admin\Statistics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationResource;

class AdminHomeStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'organization_count' => $this['organization_count'] ?? 0,
            'teacher_count' => $this['teacher_count'] ?? 0,
            'user_count' => $this['user_count'] ?? 0,
            // 'latest_students' => StatisticLatestStudentResource::collection($this['latest_students'] ?? []) ?? [],
            // 'most_active_organizations' => StatisticMostActiveOrganizationResource::collection($this['most_active_organizations'] ?? []) ?? [],
        ];
    }
}
