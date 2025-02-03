<?php

namespace App\Services\User\Rate;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\GroupStageSession;
use App\Models\SessionStudentRate\SessionStudentRate;

class RateService
{
    public function add_rate($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->session_id);
            $data['session_id'] = $session->id;
            $data['teacher_id'] = $session->teacher->id;
            $data['user_id'] = auth('user')->user()->id;
            $data['rate'] = $request->rate;
            $data['comment'] = $request->comment;

            $teacher_rate = SessionStudentRate::create($data);
            return new DataSuccess(
                status: true,
                // data: new SessionTeacherRateResource($teacher_rate),
                message: __('messages.success_create')
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
