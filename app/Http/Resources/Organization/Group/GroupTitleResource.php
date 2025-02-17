<?php

namespace App\Http\Resources\Organization\Group;


use Illuminate\Http\Request;
use App\Http\Resources\DayResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupTitleResource extends JsonResource
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
            'course_id' => $this->course_id ?? 0,
            'user_count' => $this->users()->count() ?? 0,
            'exam_count' => $this->exams()->count() ?? 0,
            'lesson_count' => $this->groupStageSessions()->count() ?? 0

        ];
    }
}
