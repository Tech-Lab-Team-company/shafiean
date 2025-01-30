<?php

namespace App\Http\Resources\Teacher\StudentReports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherStudentExamResultResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $gradeAchieved = $this->grade ?? 0;
        $totalPossibleGrade = $this->exam->degree ?? 0;
        $computedFinalGrade = "{$gradeAchieved}/{$totalPossibleGrade}";
        return [
            'id' => $this->exam->id ?? 0,
            'title' => $this->exam->name ?? '',
            'date' => $this->created_at?->format('Y-m-d') ?? '',
            'correct_answers' => $this->correct_question_count ?? 0,
            'wrong_answers' => $this->wrong_question_count ?? 0,
            'final_grade' => $computedFinalGrade,
        ];
    }
}
