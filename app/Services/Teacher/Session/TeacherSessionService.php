<?php

namespace App\Services\Teacher\Session;

use Exception;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Teacher\TeacherSessionResource;

class TeacherSessionService
{

    public function currentSession()
    {
        try {
            $toDay = Carbon::parse(Carbon::today())->format('Y-m-d');
            $teacher = Auth::guard('organization')->user();
            /** @var Teacher $teacher  */
            $sessions = $teacher->sessions()->where('date', $toDay)->get();
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
    public function nextSession()
    {
        try {
            $toDay = Carbon::parse(Carbon::today())->format('Y-m-d');
            $teacher = Auth::guard('organization')->user();
            /** @var Teacher $teacher  */
            $sessions = $teacher->sessions()->where('date', '>', $toDay)->get();
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
    public function finishedSession()
    {
        try {
            $toDay = Carbon::parse(Carbon::today())->format('Y-m-d');
            $teacher = Auth::guard('organization')->user();
            /** @var Teacher $teacher  */
            $sessions = $teacher->sessions()->where('date', '<', $toDay)->get();
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
