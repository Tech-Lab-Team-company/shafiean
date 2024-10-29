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
            'id' => $this?->id ?? 0,
            'grade' => (int)$this?->grade ?? 0,
            'status' => (int) $this?->status ?? 0,
            'questions' =>ExamResultQuestionAndAnswerResource::collection($this->examResultAnswers) ?? [],
            'exam' => new UserExamResource($this->exam ?? "") ?? "",
        ];
    }
}
