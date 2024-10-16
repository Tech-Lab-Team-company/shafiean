<?php

namespace App\Http\Controllers\User\Course;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\EndPoint\Course\FetchUserSubscriptionCourseService;

class FetchUserSubscriptionCourseController extends Controller
{
    public function __construct(protected FetchUserSubscriptionCourseService $fetchUserSubscriptionCourseService) {}
    public function __invoke()
    {
        $userId = authUser()->id;
        return $this->fetchUserSubscriptionCourseService->fetchUserSubscriptionCourse($userId)->response();
    }
}
