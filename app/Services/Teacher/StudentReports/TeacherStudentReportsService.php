<?php

namespace App\Services\Teacher\StudentReports;

use Exception;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Teacher;
use Tests\Unit\ExampleTest;
use App\Models\GroupStageSession;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Http\Resources\Teacher\Group\TeacherGroupExamResource;
use App\Http\Resources\Teacher\Session\TeacherSessionResource;
use App\Http\Resources\Teacher\Group\TeacherGroupTitleResource;
use App\Http\Resources\Teacher\Group\TeacherGroupStudentResource;
use App\Http\Resources\Teacher\Group\TeacherGroupExamDetailsResource;
use App\Http\Resources\Teacher\StudentReports\TeacherStudentAttendanceAndDepartureResource;

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
}
