<?php

namespace App\Services\Teacher\Group;

use Exception;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Teacher\Group\TeacherGroupTitleResource;

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
}
