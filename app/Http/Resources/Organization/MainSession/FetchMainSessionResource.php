<?php

namespace App\Http\Resources\Organization\MainSession;


use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchMainSessionResource extends JsonResource
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
            'status' => (int)$this->status ?? "",
            'start_verse' => (int)$this->start_verse ?? "",
            'end_verse' => (int) $this->end_verse ?? "",
            'organization_id' => $this->organization_id ?? 0,
            // 'start_date' => $this->start_date ?? "",
            // 'end_date' => $this->end_date ?? "",
            // 'start_time' => $this->start_time ?? "",
            // 'end_time' => $this->end_time ?? "",
            // 'duration' => $this->duration ?? "",
            // 'group_name' => $this->group->title ?? "",
            // "course_name" => $this->group->course->name ?? "",
            // "teacher_name" => $this->teacher->name ?? "",
            // "teacher_image" => $this->teacher->image_link ?? "",
            "quraan" => new QuraanResource($this->quraan) ?? "",
            "stage" => new StageResource($this->stage) ?? "",
        ];
    }
}
