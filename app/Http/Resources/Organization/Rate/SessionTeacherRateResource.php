<?php

namespace App\Http\Resources\Organization\Rate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionTeacherRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'session_id' => $this->session_id,
            'user_id' => $this->user_id,
            'student_understanding' => $this->student_understanding,
            's_understanding_comment' => $this->s_understanding_comment,
            'student_performance' => $this->student_performance,
            's_performance_comment' => $this->s_performance_comment
        ];
    }
}
