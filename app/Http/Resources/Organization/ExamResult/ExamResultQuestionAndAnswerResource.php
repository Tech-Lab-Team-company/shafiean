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
        // dd($this->examResultAnswers->map(fn($q) => $q->is_correct));
        $correctAnswer = Answer::where("question_id", $this?->id)->where("is_correct", 1)->first();
        // dd($correctAnswer);
        // $isCorrect = $this?->answer->is_correct;
        return [
            'id' => $this?->id ?? 0,
            'question' => $this?->question ?? "",
            'degree' => (int) $this?->degree ?? "",
            // 'is_correct' => (int)$isCorrect ?? false,
            'answer' =>  new FetchExamResultQuestionAnswerResource($this?->examResultAnswers) ?? "",
            'correct_answer' =>/* $isCorrect ? "" :*/ new FetchExamResultQuestionAnswerResource($correctAnswer) ?? ""
        ];
    }
}
