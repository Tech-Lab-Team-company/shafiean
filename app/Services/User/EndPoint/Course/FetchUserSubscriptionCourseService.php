<?php
namespace App\Services\User\EndPoint\Course;


use App\Models\Course;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\User\EndPoint\Course\FetchUserSubscriptionCourseResource;

class FetchUserSubscriptionCourseService
{

    public function fetchUserSubscriptionCourse()
    {
        try {
            $subscriptions = Subscription::whereUserId(authUser()->id)->get()->pluck('course_id')->toArray();
            $courses = Course::whereIn('id', $subscriptions)->get();
            return new DataSuccess(
                status: true,
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
