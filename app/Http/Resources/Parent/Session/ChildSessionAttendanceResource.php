<?php

namespace App\Http\Resources\Parent\Session;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildSessionAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $is_attend = $this->users()->where('user_id', $this->child_id)->exists() ? 1 : 0;
        $user_session = $this->users()->where('user_id', $this->child_id)->first();
        return [
            'id' => $this->id,
            'title' => $this->session->title ?? "",
            'teacher_name' => $this->group->teacher->name ?? "",
            'date' => $this->start_date ?? "",
            'attendance' => $is_attend,
            'from' => $is_attend ? $user_session->from : "",
            'to' => $is_attend ? $user_session->to : "",
        ];
    }
}
