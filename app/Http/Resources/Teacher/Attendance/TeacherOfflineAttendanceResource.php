<?php

namespace App\Http\Resources\Teacher\Attendance;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherOfflineAttendanceResource extends JsonResource
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
            'user_id' => $this->user->id ?? 0,
            'user_name' => $this->user->name ?? "",
            'user_image' => $this->user->image_link ?? "",
            'group_id' => $this->group->id ?? 0,
            'group_name' => $this->group->title ?? "",
            'session_id' => $this->session->id ?? 0,
            'session_name' => $this->session->session->title ?? "",
            'from' => $this->from ?? "",
            'to' => $this->to ?? "",
        ];
    }
}
