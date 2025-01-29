<?php

namespace App\Http\Resources\Teacher\Group;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherGroupStudentResource extends JsonResource
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
            'name' => $this->name ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
