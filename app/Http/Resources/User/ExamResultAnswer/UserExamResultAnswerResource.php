<?php

namespace App\Http\Resources\User\ExamResultAnswer;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Answer\AnswerResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;
use App\Http\Resources\Organization\Question\QuestionResource;
use App\Http\Resources\User\ExamResultAnswer\UserExamResultResource;
use App\Http\Resources\Organization\Exam\ExamQuestionAndAnswerResource;
use App\Http\Resources\Organization\Answer\AnswerWithOutQuestionResource;

class UserExamResultAnswerResource extends JsonResource
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
            'grade' => (int)$this->grade ?? 0,
            'exam_result' => new UserExamResultResource($this->examResult ) ?? "",
            'question' => new QuestionResource($this->question ) ?? "",
            'answer' => new AnswerWithOutQuestionResource($this->answer) ?? ""
        ];
    }
}
