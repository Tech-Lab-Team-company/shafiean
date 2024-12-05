<?php

namespace App\Http\Resources\Parent\Exam;

use App\Models\Organization\Exam\ExamGroup;
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
        // dd($this);
        $examGroup = ExamGroup::whereExamId($this->id)->first();
        $teacher = $examGroup->group->teacher;
        if (isset($this->additional['child_id'])) {
            $exam_result = $this->exam_results()->where('user_id', $this->additional['child_id'])->first();
        } else {
            $exam_result = $this->exam_results()->whereIn('user_id', $this->additional['children_ids'])->first();
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher_name' => $teacher->name,
            'teacher_image' => $teacher->image_link,
            'question_count' => $this->questions()->count(),
            'wrong_question_count' => $exam_result ? $exam_result->wrong_question_count : 0,
            'correct_question_count' => $exam_result ? $exam_result->correct_question_count : 0,
            'wrong_questions' => ChildExamResultAnswerResource::collection($exam_result->examResultAnswers()->where('is_correct', false)->get()),
        ];
    }
}
