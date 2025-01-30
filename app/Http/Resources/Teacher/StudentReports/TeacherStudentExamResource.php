<?php

namespace App\Http\Resources\Teacher\StudentReports;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organization\Answer\Answer;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherStudentExamResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $group = Subscription::where('user_id', $this->id)->first()?->group;
        $groupExamCounts =  $group ? DB::table('exam_groups')->where('group_id', $group->id)->count() : 0;
        $completedExamCount = DB::table('exam_results')->where('user_id', $this->id)->count() ?? 0;
        $answerCount = DB::table('exam_result_answers')->where('user_id', $this->id)->count() ?? 0;
        $examResult = DB::table('exam_results')->where('user_id', $this->id)->pluck('exam_id')->toArray();
        $unfinishedExams = $group ? DB::table('exam_groups')->whereNotIn('exam_id', $examResult)->where('group_id', $group->id)->count() : 0;
        return [
            'exam_count' => $groupExamCounts,
            'completed_exam_count' => $completedExamCount,
            'answer_count' => $answerCount,
            'unfinished_exam_count' => $unfinishedExams,
            'exam_results' => TeacherStudentExamResultResource::collection($this->examResults),
        ];
    }
}
