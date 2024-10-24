<?php

namespace App\Http\Resources\User\ExamResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ExamResult\UserExamResource;

class FetchExamResultsResource extends JsonResource
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
            'status' => (int) $this->status ?? 0,
            "question_count" => (int)$this->examResultAnswers()->count(),
            "total_score" => (int)$this->examResultAnswers()->sum('grade'),
            'teacher' => new FetchExamResultsTeacherResource($this?->exam?->groups?->first()?->teacher) ?? "",
            'exam' => new UserExamResource($this->exam ?? "") ?? "",
        ];
    }
}
