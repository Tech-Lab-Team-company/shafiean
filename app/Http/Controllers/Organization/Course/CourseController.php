<?php

namespace App\Http\Controllers\Organization\Course;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\AddCourseRequest;
use App\Http\Requests\Course\EditCourseRequest;
use App\Http\Requests\Course\DeleteCourseRequest;
use App\Http\Requests\Course\FetchCoursesRequest;
use App\Services\Organization\Course\CourseService;
use App\Http\Requests\Course\FetchCourseDetailsRequest;
use App\Http\Requests\Course\ChangeCourseActiveStatusRequest;

class CourseController extends Controller
{
    protected $course_service;

    public function __construct(CourseService $courseService)
    {
        $this->course_service = $courseService;
    }

    public function fetch_courses(FetchCoursesRequest $request)
    {
        return $this->course_service->fetch_courses($request)->response();
    }

    public function fetch_course_details(FetchCourseDetailsRequest $request)
    {
        return $this->course_service->fetch_course_details($request)->response();
    }

    public function add_course(AddCourseRequest $request)
    {
        return $this->course_service->add_course($request)->response();
    }

    public function edit_course(EditCourseRequest $request)
    {
        return $this->course_service->edit_course($request)->response();
    }

    public function delete_course(DeleteCourseRequest $request)
    {
        return $this->course_service->delete_course($request)->response();
    }

    public function change_course_active_status(ChangeCourseActiveStatusRequest $request)
    {
        return $this->course_service->change_course_active_status($request)->response();
    }

    public function add_course_stage(Request $request)
    {

        return $this->course_service->add_course_stage($request)->response();
    }
}
