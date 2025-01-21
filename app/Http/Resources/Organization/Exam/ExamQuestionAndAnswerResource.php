<?php

namespace App\Http\Resources\Organization\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Question\QuestionResource;
use App\Http\Resources\Organization\Exam\ExamQuestionAnswerResource;
use App\Http\Resources\Organization\Question\QuestionAnswerResource;

class ExamQuestionAndAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hasAnswer = $this->examResultAnswers()->count() ? true : false;
        return [
            'id' => $this->id ?? 0,
            'question' => $this->question ?? "",
            'type' => $this->type ?? "",
            'degree' => (int) $this->degree ?? "",
            'is_private' => (int)$this->is_private ?? "",
            'hasAnswer' => $hasAnswer ?? false,
            'answers' =>  ExamQuestionAnswerResource::collection($this->answers ?? []) ?? []
        ];
    }
}
