<?php

namespace App\Http\Resources\Teacher\StudentReports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization\Exam\ExamGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Teacher\StudentReports\TeacherStudentExamWrongAnswerResource;

class TeacherStudentExamResultDetailsResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $gradeAchieved = $this->grade ?? 0;
        $totalPossibleGrade = $this->exam->degree ?? 0;
        $computedFinalGrade = "{$gradeAchieved}/{$totalPossibleGrade}";
        $group = ExamGroup::where('exam_id', $this->exam_id)->first()?->group;
        return [
            'id' => $this->id ?? 0,
            'title' => $this->exam->name ?? '',
            'group_title' => $group->title ?? '',
            'date' => $this->created_at?->format('Y-m-d') ?? '',
            'correct_answer_count' => $this->correct_question_count ?? 0,
            'wrong_answer_count' => $this->wrong_question_count ?? 0,
            'final_grade' => $computedFinalGrade,
            'wrong_answers' => TeacherStudentExamWrongAnswerResource::collection($this->examResultAnswers()->where('is_correct', false)->get()),
        ];
    }
}
