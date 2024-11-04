<?php

namespace App\Http\Resources\Organization\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;

class ExamResource extends JsonResource
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
            // 'question_count' => $this->question_count ?? 0,
            // 'exam_type' => $this->exam_type ?? '',
            // 'degree_type' => $this->degree_type ?? '',
            // 'degree' => $this->degree ?? 0,
            'status' => $this->status ?? 0,
            'groups' => ExamGroupResource::collection($this->groups ?? []) ?? [],
            "questions" => ExamQuestionAndAnswerResource::collection($this->questions ?? []) ?? "",
            // "bank_questions" => ExamQuestionAndAnswerResource::collection($this->bankQuestions ?? []) ?? ""
        ];
    }
}
