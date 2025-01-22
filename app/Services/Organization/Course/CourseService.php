<?php

namespace App\Services\Organization\Course;

use Exception;
use App\Models\Course;
use App\Models\Curriculum;
use App\Enum\HasCurriculumEnum;
use App\Models\CourseStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CourseResource;
use App\Models\CourseStage;
use App\Models\MainSession;
use App\Services\Global\FilterService;

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
    private function storeCourseStageSession($courseStages, $mainSessions, $course)
    {
        $organizationId = get_organization_id(auth()->guard('organization')->user());
        foreach ($courseStages  as $stage) {
            foreach ($mainSessions as $session) {
                CourseStageSession::create([
                    'course_stage_id' => $stage->id,
                    'session_id' => $session->id,
                    // 'organization_id' => $organizationId,
                    'course_id' => $course->id,
                    'stage_id' => $stage->stage_id,
                    'session_type_id' => $session->session_type_id,
                    'start_verse' => intval($session->start_verse),
                ]);
            }
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
            $data['season_id'] = $request->season_id;
            $data['all_curriculum'] = $request->all_curriculum;
            $data['curriculum_id'] = $request->curriculum_id;
            $course = Course::create($data);
            $course->disability_types()->attach($request->disability_ids);
            if ($request->all_curriculum == HasCurriculumEnum::HAS_CURRICULUM->value) {
                $curriclumStages = Curriculum::find($request->curriculum_id)->stages;
                $stageIds = $curriclumStages->pluck('id')->toArray();
                $mainSessions = MainSession::whereIn('stage_id', $stageIds)->get();
                $course->stages()->attach($stageIds);
            } else {
                $mainSessions = MainSession::whereIn('stage_id', $request->stage_ids)->get();
                $course->stages()->attach($request->stage_ids);
            }
            $courseStages = CourseStage::where('course_id', $course->id)->get();
            $this->storeCourseStageSession($courseStages, $mainSessions, $course);

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
            $data['season_id'] = $request->season_id;
            $data['name'] = $request->name ?? $course->name;
            $data['year_id'] = $request->year_id ?? $course->year_id;
            $data['curriculum_id'] = $request->curriculum_id ?? $course->curriculum_id;
            $course->update($data);
            if (isset($request->disability_ids)) {
                $course->disability_types()->sync($request->disability_ids);
            }
            if ($request->all_curriculum == HasCurriculumEnum::HAS_CURRICULUM->value) {
                $curriclumStages = Curriculum::find($request->curriculum_id)->stages;
                $stageIds = $curriclumStages->pluck('id')->toArray();
                $mainSessions = MainSession::whereIn('stage_id', $stageIds)->get();
                $course->stages()->sync($stageIds);
            } else {
                $mainSessions = MainSession::whereIn('stage_id', $request->stage_ids)->get();
                $course->stages()->sync($request->stage_ids);
            }
            $courseStages = CourseStage::where('course_id', $course->id)->get();
            $this->storeCourseStageSession($courseStages, $mainSessions, $course);
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
            $hasGroups = $course->groups()->count() ? true : false;
            if ($hasGroups) {
                return new DataSuccess(
                    status: false,
                    statusCode: 200,
                    message: 'لا يمكن مسح الدوره ان كانت تحتوى علي مجاميع'
                );
            }
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

    public function add_course_stage($request): DataStatus
    {
        try {
            $course = Course::find($request->course_id);

            $stage_ids = collect($request->stages)->pluck('stage_id')->toArray();
            $course->stages()->attach($stage_ids);

            // Get the correct mapping of course_stage_id for each stage
            $course_stage_ids = $course->stages()->whereIn('stage_id', $stage_ids)->pluck('course_stages.id', 'stage_id')->toArray();


            foreach ($request->stages as $stage) {
                $course_stage_session_data['stage_id'] = $stage['stage_id'];

                // Get the correct course_stage_id for this stage
                $course_stage_id = $course_stage_ids[$stage['stage_id']];
                // dd($course_stage_id);
                $course_stage_sessions = [];
                foreach ($stage['sessions'] as $session) {
                    $course_stage_session_data['session_id'] = $session['session_id'];
                    $course_stage_session_data['with_edit'] = $session['with_edit'];
                    $course_stage_session_data['start_verse'] = $session['start_verse'] ?? null;
                    $course_stage_session_data['end_verse'] = $session['end_verse'] ?? null;
                    $course_stage_session_data['session_type_id'] = $session['session_type_id'];
                    $course_stage_session_data['course_id'] = $request->course_id;
                    $course_stage_session_data['course_stage_id'] = $course_stage_id; // Assign correct course_stage_id
                    $course_stage_sessions[] = $course_stage_session_data;
                }
                // dd($course_stage_sessions);
                CourseStageSession::insert($course_stage_sessions);
            }

            return new DataSuccess(
                status: true,
                message: 'Course stage added successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
