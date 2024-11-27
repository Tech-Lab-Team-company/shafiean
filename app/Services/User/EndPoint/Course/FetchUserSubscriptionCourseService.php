<?php
namespace App\Services\User\EndPoint\Course;


use App\Models\Course;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\EndPoint\Course\FetchUserSubscriptionCourseResource;

class FetchUserSubscriptionCourseService
{

    public function fetchUserSubscriptionCourse($userId)
    {
        try {
            $subscriptions = Subscription::whereUserId($userId)->whereNotNull('course_id')->get()->pluck('course_id')->toArray();
            $courses = Course::whereIn('id', $subscriptions)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                status: true,
                message: 'Courses retrieved successfully',
                data: FetchUserSubscriptionCourseResource::collection($courses)->response()->getData(true),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
