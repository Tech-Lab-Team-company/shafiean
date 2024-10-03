<?php

namespace App\Http\Controllers\User\Course;

use App\Http\Controllers\Controller;
use App\Services\User\Course\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService){
        $this->courseService = $courseService;
    }


    public function fetch_courses(Request $request){
        return $this->courseService->fetch_courses($request)->response();
    }
}
