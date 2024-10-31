<?php

namespace App\Http\Resources\Admin\Statistics\Count;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationResource;

class AdminHomeCountStatisticResource extends JsonResource
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
        ];
    }
}
