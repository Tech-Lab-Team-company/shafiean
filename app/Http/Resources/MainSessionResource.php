<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainSessionResource extends JsonResource
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
            'title' => $this->session->title ?? "",
            'status' => $this->session->status ?? "",
            'start_verse' => $this->start_verse ?? "",
            'end_verse' => $this->end_verse ?? "",
            'start_date' => $this->start_date ?? "",
            'end_date' => $this->end_date ?? "",
            'start_time' => $this->start_time ?? "",
            'end_time' => $this->end_time ?? "",
            'duration' => $this->duration ?? "",
            'group_name' => $this->group->title ?? "",
            "course_name" => $this->group->course->name ?? "",
            "teacher_name" => $this->teacher->name ?? "",
            "teacher_image" => $this->teacher->image_link ?? "",
            "quraan" => new QuraanResource($this->quraan) ?? "",
            "stage" => new StageResource($this->stage) ?? "",
        ];
    }
}
