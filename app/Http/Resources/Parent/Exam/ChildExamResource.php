<?php

namespace App\Http\Resources\Parent\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $exam_result = $this->exam_results()->where('user_id', $this->child_id)->first();
        // dd($exam_result);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'question_count' => $this->questions()->count(),
            'wrong_question_count' => $exam_result ? $exam_result->wrong_question_count : 0,
            'correct_question_count' => $exam_result ? $exam_result->correct_question_count : 0,
            'wrong_questions' => ChildExamResultAnswerResource::collection($exam_result->examResultAnswers()->where('is_correct', false)->get()),
        ];
    }
}
