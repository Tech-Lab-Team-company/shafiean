<?php

namespace App\Http\Resources\Organization\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;
use App\Http\Resources\Organization\Question\QuestionAndAnswerResource;

class FullExamQuestionResource extends JsonResource
{
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
            'question_count' => $this->question_count ?? 0,
            'exam_type' => $this->exam_type ?? '',
            'degree_type' => $this->degree_type ?? '',
            'degree' => $this->degree ?? 0,
            'status' => $this->status ?? 0,
            'groups' => ExamGroupResource::collection($this->groups ?? []) ?? [],
            'questions' => QuestionAndAnswerResource::collection($this->questions ?? [])??[]

        ];
    }
}
