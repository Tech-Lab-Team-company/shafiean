<?php

namespace App\Http\Resources\Organization\ExamResult;



use Illuminate\Http\Request;
use App\Models\Organization\Answer\Answer;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Question\QuestionAnswerResource;
use App\Http\Resources\User\ExamResult\FetchExamResultQuestionAnswerResource;

class ExamResultQuestionAndAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $correctAnswer = Answer::where("question_id", $this?->question?->id)->where("is_correct", 1)->first();
        $isCorrect = $this?->answer->is_correct;
        return [
            'id' => $this?->question?->id ?? 0,
            'question' => $this?->question?->question ?? "",
            'degree' => (int) $this?->question?->degree ?? "",
            'is_correct' => (int)$isCorrect ?? false,
            'answer' =>  new FetchExamResultQuestionAnswerResource($this?->answer) ?? "",
            'correct_answer' => $isCorrect ? "" : new FetchExamResultQuestionAnswerResource($correctAnswer) ?? ""
        ];
    }
}
