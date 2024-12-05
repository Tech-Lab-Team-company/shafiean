<?php

namespace App\Http\Resources\Parent\Child;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildSessionTeacherReateResource extends JsonResource
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
            'session_name' => $this->session->title ?? "",
            'teacher_name' => $this->teacher->name ?? "",
            'student_understanding' => $this->student_understanding ?? 0,
            's_understanding_comment' => $this->s_understanding_comment ?? "",
            'student_performance' => $this->student_performance ?? 0,
            's_performance_comment' => $this->s_performance_comment ?? "",
            'rate_date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
