<?php

namespace App\Http\Resources\Parent\Session;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchChildSessionResource extends JsonResource
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
            'title' => $this->session->title ?? "",
            "group_name" => $this->group->title ?? "",
            "curriculum_name" => $this->group->course->curriculum->title ?? "",
            "teacher_name" => $this->group->teacher->name ?? "",
            "teacher_image" => $this->group->teacher->image_link ?? "",
            'start_time' => $this->session->start_time ?? "",
            'end_time' =>$this->session->end_time ?? "",
        ];
    }
}
