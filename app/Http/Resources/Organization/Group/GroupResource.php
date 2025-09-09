<?php

namespace App\Http\Resources\Organization\Group;


use Illuminate\Http\Request;
use App\Http\Resources\DayResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'course' => new CourseResource($this->course),
            // 'start_time' => $this->start_time,
            // 'end_time' => $this->end_time,
            // 'status' => $this->status,
            // 'with_all_disability' => $this->with_all_disability,
            // 'with_all_course_content' => $this->with_all_course_content,
            // 'days' => DayResource::collection($this->days),
            // 'course' => new CourseResource($this->course),
            // "stages" => GroupStageResource::collection($this->stages ?? []) ?? [],

        ];
    }
}
