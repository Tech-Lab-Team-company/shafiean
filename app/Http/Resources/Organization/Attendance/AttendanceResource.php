<?php

namespace App\Http\Resources\Organization\Attendance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'group_id' => $this->group->id,
            'group_name' => $this->group->title,
            'session_id' => $this->session->id,
            'session_name' => $this->session->session->title,
            'from' => $this->from,
            'to' => $this->to,

        ];
    }
}
