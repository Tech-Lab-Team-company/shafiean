<?php

namespace App\Http\Resources\Organization\ExamResult;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ExamResult\UserExamResource;
use App\Http\Resources\Organization\ExamResult\ExamResultQuestionAndAnswerResource;

class ExamResultAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->examResult?->id ?? 0,
            'grade' => (int)$this?->examResult?->grade ?? 0,
            'status' => (int) $this?->examResult?->status ?? 0,
            'question' => new ExamResultQuestionAndAnswerResource($this->question ) ?? [],
            'exam' => new UserExamResource($this->examResult?->exam ?? "") ?? "",
        ];
    }
}
