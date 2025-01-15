<?php

namespace App\Http\Resources\Organization\GroupExamQuestion;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Answer\AnswerResource;
use App\Http\Resources\Organization\Question\QuestionAnswerResource;
use App\Http\Resources\Organization\Question\QuestionSeasonResource;
use App\Http\Resources\Organization\Question\QuestionCurriculumResource;
use App\Http\Resources\Organization\GroupExamQuestion\GroupExamQuestionAnswerResource;

class GroupExamQuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'question' => $this->question ?? "",
            'type' => $this->type ?? "",
            'degree' => (int) $this->degree ?? "",
            'is_private' => (int)$this->is_private ?? "",
            'ansewers' => GroupExamQuestionAnswerResource::collection($this->answers ?? ""),
        ];
    }
}
