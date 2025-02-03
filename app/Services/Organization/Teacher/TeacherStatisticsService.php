<?php

namespace App\Services\Organization\Teacher;


use Exception;
use App\Models\User;
use App\Models\Group;
use App\Enum\UserTypeEnum;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamGroup;
use App\Http\Resources\Organization\Group\GroupTitleResource;
use App\Http\Resources\Organization\Exam\ExamWithOutQuestionResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Organization\Teacher\Statistics\Count\TeacherStatisticCountResource;

class TeacherStatisticsService
{
    public function fetchCounts()
    {
        try {
            $lessons = $this->lessonCount();
            $students = $this->studentCount();
            $groups = $this->groupCount();
            return new DataSuccess(
                data: new TeacherStatisticCountResource([
                    'lesson_count' => $lessons,
                    'student_count' => $students,
                    'group_count' => $groups,
                ]),
                status: true,
                message: 'fetch Count Statistics successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function teacherGroup()
    {
        try {

            $groups = Group::whereTeacherId(Auth::guard('organization')->user()->id)->paginate(10);
            return new DataSuccess(
                data: GroupTitleResource::collection($groups)->response()->getData(true),
                status: true,
                message: 'fetch teacher group successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMainSessions($dataRequest)
    {
        try {
            $groupStageSessions =  Group::whereId($dataRequest->group_id)->first()->groupStageSessions()->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: FetchMainSessionResource::collection($groupStageSessions)->response()->getData(true),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchExams()
    {
        try {
            $groups = Group::whereTeacherId(Auth::guard('organization')->user()->id)->pluck('id')->unique()->toArray();
            $examGroup = ExamGroup::whereIn('group_id', $groups)->pluck('exam_id')->unique()->toArray();
            $exams = Exam::whereIn('id', $examGroup)->paginate(10);


            return new DataSuccess(
                data: ExamWithOutQuestionResource::collection($exams)->response()->getData(true),
                status: true,
                message: 'fetch teacher exam successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    private function studentCount()
    {
        return User::whereType(UserTypeEnum::STUDENT->value)->count();
    }
    private function lessonCount()
    {
        return Group::with('groupStageSessions')->get()->count();
    }
    private function groupCount()
    {
        return Group::whereTeacherId(Auth::user()->id)->count();
    }
}
