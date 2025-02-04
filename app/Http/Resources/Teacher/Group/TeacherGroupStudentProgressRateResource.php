<?php

namespace App\Http\Resources\Teacher\Group;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentGroupResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentDisabilityTypeResource;

class TeacherGroupStudentProgressRateResource  extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'months' => $this['months'] ?? 0,
            'grade' => $this['grade'] ?? 0,
        ];
    }
}
