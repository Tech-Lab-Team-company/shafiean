<?php

namespace App\Http\Resources\User\ExamResult;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;
use App\Http\Resources\Organization\Exam\ExamQuestionAndAnswerResource;

class UserExamResource extends JsonResource
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
            'name' => $this->name ?? '',
            'start_date' => $this->start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'start_time' => $this->start_time ?? '',
            'end_time' => $this->end_time ?? '',
            'duration' => $this->duration ?? '',
            'question_count' => (int) $this?->questions()->count() ?? 0,
            'total_degree' => (int) $this?->questions()->sum('degree') ?? 0,
            'exam_type' => $this->exam_type ?? '',
            'degree_type' => $this->degree_type ?? '',
            'status' => $this->status ?? 0,
        ];
    }
}
