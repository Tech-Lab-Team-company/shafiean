<?php

namespace App\Http\Resources\Organization\ExamResult;


use Illuminate\Http\Request;
use App\Models\Organization\Answer\Answer;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ExamResult\UserExamResource;
use App\Http\Resources\Organization\ExamResult\ExamNameResource;
use App\Http\Resources\Organization\ExamResult\ExamResultUserResource;
use App\Http\Resources\User\ExamResult\FetchExamResultsTeacherResource;
use App\Http\Resources\User\ExamResult\FetchExamResultQuestionAnswerResource;
use App\Http\Resources\User\ExamResult\FetchExamResultQuestionAndAnswerResource;

class ExamResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $correctAnswerCount = $this->examResultAnswers->filter(fn($q) => $q->answer()->where("is_correct", 1)->exists())->count();
        return [
            'id' => $this->id ?? 0,
            'grade' => (int)$this->grade ?? 0,
            'status' => (int) $this->status ?? 0,
            'question_count' => (int) $this?->exam?->questions()->count() ?? 0,
            'total_degree' => (int) $this?->exam?->questions()->sum('degree') ?? 0,
            "answer_count" => (int)$this->examResultAnswers()->count() ?? 0,
            'correct_answer_count' => $correctAnswerCount ?? 0,
            'user' => new ExamResultUserResource($this->user) ?? "",
            'teacher' => new FetchExamResultsTeacherResource($this?->exam?->groups?->first()?->teacher) ?? "",
            'exam' => new ExamNameResource($this->exam) ?? "",

        ];
    }
}
