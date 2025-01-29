<?php

namespace App\Http\Resources\Teacher\Group;

use Illuminate\Http\Request;
use App\Http\Resources\DayResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherGroupExamResource extends JsonResource
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
            'title' => $this->name ?? "",
            'questions_count' => $this->questions()->count() ?? 0,
            'exam_type' => $this->exam_type ?? 0,
        ];
    }
}
