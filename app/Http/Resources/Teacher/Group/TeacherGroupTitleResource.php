<?php

namespace App\Http\Resources\Teacher\Group;


use Illuminate\Http\Request;
use App\Http\Resources\DayResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherGroupTitleResource extends JsonResource
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
