<?php

namespace App\Http\Resources\Teacher\StudentReports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization\Exam\ExamGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Teacher\StudentReports\TeacherStudentExamWrongAnswerResource;
use Carbon\Carbon;

class TeacherStudentRatingsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'session_title' => $this->groupStageSession?->session_id ? $this->groupStageSession?->session?->title : $this->groupStageSession?->title,
            'student_understanding_level' => $this->student_understanding ?? 0,
            'student_understanding_comment' => $this->s_understanding_comment ?? "",
            'student_performance_level' => $this->student_performance ?? 0,
            'student_performance_comment' => $this->s_performance_comment ?? "",
            'date' => Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}
