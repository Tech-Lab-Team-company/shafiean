<?php

namespace App\Services\Global;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\DayResource;
use App\Models\Day;
use App\Models\Organization\Exam\ExamStudent;
use Exception;

class GlobalService
{

    public function fetch_days($request): DataStatus
    {
        try {

            $days = Day::query();
            if ($request) {
                $filter_service = new FilterService();
                $filter_service->filterDay($request, $days);
            }
            $days = $days->get();
            return new DataSuccess(
                data: DayResource::collection($days),
                status: true,
                message: 'Days retrieved successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function fetch_exam_students($request): DataStatus
    {
        try {

            $examStudents = ExamStudent::query();
            // if ($request) {
            //     $filter_service = new FilterService();
            //     $filter_service->filterDay($request, $days);
            // }
            $days = $examStudents->get();
            return new DataSuccess(
                data: DayResource::collection($days),
                status: true,
                message: 'Fetch exam students  successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
