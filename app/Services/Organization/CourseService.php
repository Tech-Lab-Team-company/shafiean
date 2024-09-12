<?php

namespace App\Services\Organization;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\Global\FilterService;
use Exception;

class CourseService
{
    public function fetch_courses($request): DataStatus
    {
        try {

            $query = Course::query();
            if ($request) {
                $filter_service = new FilterService();
                $filter_service->filterCourse($request, $query);
            }
            $courses = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: CourseResource::collection($courses)->response()->getData(true),
                status: true,
                message: 'Courses retrieved successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function fetch_course_details($request): DataStatus
    {
        try {
            $course = Course::find($request->id);
            return new DataSuccess(
                data: new CourseResource($course),
                status: true,
                message: 'Course retrieved successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function add_course($request): DataStatus
    {
        try {
            if ($request->hasFile('image')) {
                $image = upload_image($request->file('image'), 'courses');
                $data['image'] = $image;
            }
            $data['name'] = $request->name;
            $data['year_id'] = $request->year_id;
            $data['curriculum_id'] = $request->curriculum_id;
            $course = Course::create($data);
            $course->disability_types()->attach($request->disability_ids);
            // dd($course);
            return new DataSuccess(
                status: true,
                data: new CourseResource($course),
                message: 'Course created successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function edit_course($request): DataStatus
    {
        try {
            $course = Course::find($request->id);
            if ($request->hasFile('image')) {
                if ($course->image && file_exists($course->image)) {
                    delete_image($course->image);
                }
                $image = upload_image($request->file('image'), 'courses');
                $data['image'] = $image;
            }
            $data['name'] = $request->name ?? $course->name;
            $data['year_id'] = $request->year_id ?? $course->year_id;
            $data['curriculum_id'] = $request->curriculum_id ?? $course->curriculum_id;
            $course->update($data);
            if (isset($request->disability_ids)) {
                $course->disability_types()->sync($request->disability_ids);
            }
            return new DataSuccess(
                status: true,
                data: new CourseResource($course),
                message: 'Course updated successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function delete_course($request): DataStatus
    {
        try {
            $course = Course::find($request->id);
            $course->delete();
            return new DataSuccess(
                status: true,
                message: 'Course deleted successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function change_course_active_status($request): DataStatus
    {
        try {
            $course = Course::find($request->id);
            if ($course->status == 1) {
                $course->status = 0;
            } else {
                $course->status = 1;
            }
            $course->save();
            return new DataSuccess(
                status: true,
                data: new CourseResource($course),
                message: 'Course status changed successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
