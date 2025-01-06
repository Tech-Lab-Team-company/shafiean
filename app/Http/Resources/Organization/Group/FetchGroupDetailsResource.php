<?php

namespace App\Http\Resources\Organization\Group;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Group\GroupDayResource;
use App\Http\Resources\Organization\Group\GroupStageResource;
use App\Http\Resources\Organization\Group\GroupCourseResource;
use App\Http\Resources\Organization\Group\GroupDisabilityTypeResource;

class FetchGroupDetailsResource extends JsonResource
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
            'start_date' => $this->start_date ?? "",
            // 'end_date' => $this->end_date ?? "",
            // 'start_time' => $this->start_time ?? "",
            // 'end_time' => $this->end_time ?? "",
            // 'status' => $this->status ?? "",
            // 'with_all_disability' => $this->with_all_disability ?? 0,
            // 'with_all_course_content' => $this->with_all_course_content ?? 0,
            // 'teacher' => new GroupTeacherResource($this->teacher??"") ?? "",
            'course' => new GroupCourseResource($this->course ?? "") ?? "",
            // "stages" => GroupStageResource::collection($this->stages ?? []) ?? [],
            // 'days' => GroupDayResource::collection($this->days ?? []) ?? [],
            // 'disabilities' => GroupDisabilityTypeResource::collection($this->disabilities ?? []) ?? [],
        ];
    }
}
