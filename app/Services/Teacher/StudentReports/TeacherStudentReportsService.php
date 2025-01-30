<?php

namespace App\Services\Teacher\StudentReports;

use Exception;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamResult;
use App\Http\Resources\Teacher\StudentReports\TeacherStudentExamResource;
use App\Http\Resources\Teacher\StudentReports\TeacherStudentAttendanceAndDepartureResource;
use App\Models\User;

class TeacherStudentReportsService
{

    public function StudentAttendanceAndDeparture($dataRequest)
    {
        try {
            $groupStageSessions = GroupStageSession::query();
            $groupStageSessions->when($dataRequest->word, function ($query) use ($dataRequest) {
                $query->whereHas('session', function ($q) use ($dataRequest) {
                    $q->where('title', 'like', '%' . $dataRequest->word . '%');
                })->orwhere('title', 'like', '%' . $dataRequest->word . '%');
            });
            $data = $groupStageSessions->orderBy('id', 'desc')->paginate(8);
            return new DataSuccess(
                data: TeacherStudentAttendanceAndDepartureResource::collection($data),
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

    public function studentExams($dataRequest)
    {
        try {
            $student = User::whereId($dataRequest->user_id)->first();
            return new DataSuccess(
                data: new TeacherStudentExamResource($student),
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
