<?php

namespace App\Services\Organization\Rate;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Rate\SessionTeacherRateResource;
use App\Models\SessionTeacherRate\SessionTeacherRate;

class RateService
{
    public function add_rate($request): DataStatus
    {
        try {
            // $data['session_id'] = $request->session_id;
            $data['teacher_id'] = auth('organization')->user()->id;
            // $data['user_id'] = $request->user_id;
            $data['student_understanding'] = $request->student_understanding;
            $data['s_understanding_comment'] = $request->s_understanding_comment;
            $data['student_performance'] = $request->student_performance;
            $data['s_performance_comment'] = $request->s_performance_comment;
            $attributes = [
                'session_id' => intval($request->session_id),
                'user_id' => intval($request->user_id),
            ];
            $teacher_rate = SessionTeacherRate::updateOrCreate($attributes, $data);
            // $teacher_rate = SessionTeacherRate::create($data);
            return new DataSuccess(
                status: true,
                // data: new SessionTeacherRateResource($teacher_rate),
                message: 'Rate added successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetch_rate_details($request): DataStatus
    {
        try {

            $teacher_rate = SessionTeacherRate::where('session_id', $request->session_id)->where('user_id', $request->user_id)->first();
            // $teacher_rate = SessionTeacherRate::create($data);
            return new DataSuccess(
                status: true,
                data: new SessionTeacherRateResource($teacher_rate),
                message: 'Rate added successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
