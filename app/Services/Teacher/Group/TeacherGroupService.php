<?php

namespace App\Services\Teacher\Group;

use Exception;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Teacher\Session\TeacherSessionResource;

class TeacherGroupService
{

    public function teacherGroup()
    {
        try {
            /** @var Teacher $teacher  */

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
}
