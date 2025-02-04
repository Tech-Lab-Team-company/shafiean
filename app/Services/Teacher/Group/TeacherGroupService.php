<?php

namespace App\Services\Teacher\Group;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Teacher;
use Carbon\CarbonPeriod;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamGroup;
use App\Models\Organization\Exam\ExamResult;
use App\Http\Resources\Teacher\Group\TeacherGroupExamResource;
use App\Http\Resources\Teacher\Session\TeacherSessionResource;
use App\Http\Resources\Teacher\Group\TeacherGroupTitleResource;
use App\Http\Resources\Teacher\Group\TeacherGroupStudentResource;
use App\Http\Resources\Teacher\Group\TeacherGroupExamDetailsResource;
use App\Http\Resources\Teacher\Group\TeacherGroupLastSessionResource;
use App\Http\Resources\Teacher\Group\TeacherGroupStudentProgressRateResource;

class TeacherGroupService
{

    public function teacherGroup()
    {
        try {
            /** @var Teacher $teacher  */
            $teacher = Auth::guard('organization')->user();
            $groups = Group::whereHas('groupStageSessions', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);
            })->distinct()->get();
            return new DataSuccess(
                data: TeacherGroupTitleResource::collection($groups),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupSessions($dataRequest)
    {
        try {
            $sessions = Group::find($dataRequest->group_id)->groupStageSessions()->get();
            return new DataSuccess(
                data: TeacherSessionResource::collection($sessions),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupStudents($dataRequest)
    {
        try {
            $students = Group::find($dataRequest->group_id)->users()->distinct()->get();
            return new DataSuccess(
                data: TeacherGroupStudentResource::collection($students),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupExams($dataRequest)
    {
        try {
            // $exams = Group::find($dataRequest->group_id)->exams()->distinct()->get();
            $query = Group::find($dataRequest->group_id)->exams()->distinct();
            $query->when($dataRequest->word, function ($q) use ($dataRequest) {
                $q->where('name', 'like', '%' . $dataRequest->word . '%');
            });
            $exams = $query->get();
            return new DataSuccess(
                data: TeacherGroupExamResource::collection($exams),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupExamDetails($dataRequest)
    {
        try {
            $exam = Exam::find($dataRequest->exam_id);
            return new DataSuccess(
                data: new TeacherGroupExamDetailsResource($exam),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherExams($dataRequest)
    {
        try {
            /** @var Teacher $teacher  */
            $teacher = Auth::guard('organization')->user();
            // $exams = $teacher->sessions()->with('group.exams')->get()->pluck('group.exams')->flatten()->unique();
            $query = $teacher->sessions()->with(['group.exams' => function ($q) use ($dataRequest) {
                if ($dataRequest->filled('word')) {
                    $q->where('name', 'like', '%' . $dataRequest->word . '%');
                }
            }]);
            $exams = $query->get()
                ->pluck('group.exams')
                ->flatten()
                ->unique();
            return new DataSuccess(
                data: TeacherGroupExamResource::collection($exams),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupLastSessions($dataRequest)
    {
        try {
            $sessions = Group::find($dataRequest->group_id)->groupStageSessions()->orderBy('created_at', 'desc')->take(3)->get();
            return new DataSuccess(
                data: TeacherGroupLastSessionResource::collection($sessions),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroupStudentProgressRate($dataRequest)
    {
        try {
            $examIds = ExamGroup::where('group_id', $dataRequest->group_id)->pluck('exam_id')->toArray();
            $startDate = Carbon::now()->subMonths(7)->startOfMonth();
            $endDate = Carbon::now()->subMonth()->endOfMonth();
            $period = CarbonPeriod::create($startDate, '1 month', $endDate);
            $months = [];
            $averageGrades = [];
            foreach ($period as $date) {
                $months[] = $date->format('M');
                $averageGrades[] = round(ExamResult::whereIn('exam_id', $examIds)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->avg('grade') ?? 0);
            }
            return new DataSuccess(
                data: new TeacherGroupStudentProgressRateResource([
                    'months' => $months,
                    'grade' => $averageGrades
                ]),
                status: true,
                message: 'Data fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
