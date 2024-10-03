<?php

namespace App\Services\User\Course;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseService
{
    public function fetch_courses($request): DataStatus
    {
        try {
            $courses = Course::paginate(10);
            return new DataSuccess(
                data: CourseResource::collection($courses)->response()->getData(true),
                status: true,
                message: 'Courses retrieved successfully'
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
