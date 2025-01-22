<?php

namespace App\Services\Organization\Group;

use Exception;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Course;
use App\Models\GroupStage;
use App\Enum\HasCourseEnum;
use App\Models\MainSession;
use App\Enum\HasDisabilityEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\Organization\Group\GroupResource;
use App\Http\Resources\Organization\Group\FetchGroupDetailsResource;

class GroupService
{
    public function fetch_groups($request): DataStatus
    {
        try {
            $query = Group::query();
            if ($request) {
                $filter_service = new FilterService();
                $filter_service->filterGroup($request, $query);
            }
            $groups = $query->orderBy('id', 'desc')->paginate(10);

            return new DataSuccess(
                data: $groups ? GroupResource::collection($groups)->response()->getData(true) : [],
                status: true,
                message: 'Groups retrieved successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }


    private function storeGroupStageSessions($groupStages, $mainSessions, $group)
    {
        // dd($groupStages, $mainSessions, $group);
        foreach ($groupStages as $stage) {
            foreach ($mainSessions as $session) {
                GroupStageSession::create([
                    'group_stage_id' => $stage->id,
                    'session_id' => $session->id,
                    'group_id' => $group->id,
                    'stage_id' => $stage->stage_id,
                    'session_type_id' => $session->session_type_id,
                    'start_verse' => (int) $session->start_verse,
                    'end_verse' => (int) $session->end_verse,
                ]);
            }
        }
    }
    public function add_group($request): DataStatus
    {
        try {
            $group = Group::create([
                'title' => $request->title,
                'course_id' => $request->course_id,
                // 'teacher_id' => $request->teacher_id,
                'start_date' => $request->start_date,
                // 'end_date' => $request->end_date,
                // 'with_all_disability' => $request->with_all_disability,
                // 'with_all_course_content' => $request->with_all_course_content,
            ]);
            // if ($request->days) {
            //     foreach ($request->days as $day) {
            //         $group->days()->attach($day['day_id'], ['start_time' => $day['start_time'], 'end_time' => $day['end_time']]);
            //     }
            // }
            // if ($request->with_all_disability == HasDisabilityEnum::NOT_HAS_DISABILITY->value && $request->disabilities) {
            //     $group->disabilities()->attach($request->disabilities, ['course_id' => $request->course_id]);
            // }
            // if ($request->with_all_disability == HasDisabilityEnum::HAS_DISABILITY->value) {
            //     $course_disapility_ids = Course::find($request->course_id)->disability_types->pluck('id')->toArray();
            //     $group->disabilities()->attach($course_disapility_ids, ['course_id' => $request->course_id]);
            // }
            // if ($request->with_all_course_content == HasCourseEnum::HAS_COURSE->value) {
            //     $courseStages = Course::find($request->course_id)->stages;
            //     $stageIds = $courseStages->pluck('id')->toArray();
            //     $mainSessions = MainSession::whereIn('stage_id', $stageIds)->get();
            //     $group->stages()->attach($stageIds);
            // } else {
            //     $mainSessions = MainSession::whereIn('stage_id', $request->stages)->get();
            //     $group->stages()->attach($request->stages);
            // }
            // $groupStages = GroupStage::where('group_id', $group->id)->get();
            // $this->storeGroupStageSessions($groupStages, $mainSessions, $group);
            return new DataSuccess(
                data: new GroupResource($group),
                status: true,
                message: 'Group created successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,  // false
                message: $exception->getMessage()
            );
        }
    }

    public function fetch_group_details($request): DataStatus
    {
        try {
            $group = Group::find($request->id);
            return new DataSuccess(
                data: new FetchGroupDetailsResource($group),
                status: true,
                message: 'Group retrieved successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function edit_group($request): DataStatus
    {
        try {
            $group = Group::find($request->id);
            $group->update([
                'title' => $request->title,
                'course_id' => $request->course_id,
                // 'teacher_id' => $request->teacher_id,
                'start_date' => $request->start_date,
                // 'end_date' => $request->end_date,
                // 'with_all_disability' => $request->with_all_disability,
                // 'with_all_course_content' => $request->with_all_course_content,
            ]);
            // if ($request->days) {
            //     $days = [];
            //     foreach ($request->days as $day) {
            //         $days[$day['day_id']] = ['start_time' => $day['start_time'], 'end_time' => $day['end_time']];
            //     }
            //     $group->days()->sync($days);
            // }
            // if ($request->with_all_disability == HasDisabilityEnum::NOT_HAS_DISABILITY->value && $request->disabilities) {
            //     $disabilitiesWithCourseId = [];
            //     foreach ($request->disabilities as $disabilityId) {
            //         $disabilitiesWithCourseId[$disabilityId] = ['course_id' => $request->course_id];
            //     }
            //     $group->disabilities()->sync($disabilitiesWithCourseId);
            // }

            // if ($request->with_all_disability == HasDisabilityEnum::HAS_DISABILITY->value) {
            //     $course_disapility_ids = Course::find($request->course_id)->disability_types->pluck('id')->toArray();
            //     $group->disabilities()->sync($course_disapility_ids);
            // }

            // if ($request->with_all_course_content == HasCourseEnum::HAS_COURSE->value) {
            //     $courseStages = Course::find($request->course_id)->stages;
            //     $stageIds = $courseStages->pluck('id')->toArray();
            //     $mainSessions = MainSession::whereIn('stage_id', $stageIds)->get();
            //     $group->stages()->sync($stageIds);
            // } else {
            //     $mainSessions = MainSession::whereIn('stage_id', $request->stages)->get();
            //     $group->stages()->sync($request->stages);
            // }
            // $groupStages = GroupStage::where('group_id', $group->id)->get();
            // $this->storeGroupStageSessions($groupStages, $mainSessions, $group);
            return new DataSuccess(
                data: new GroupResource($group),
                status: true,
                message: 'Group updated successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function delete_group($request): DataStatus
    {
        try {
            $group = Group::find($request->id);
            if (!$group) {
                return new DataFailed(
                    status: false,
                    statusCode: 400,
                    message: 'Group not found'
                );
            }
            $hasSession = $group->groupStageSessions()->count() ? true : false;
            $hasExam = $group->exams()->count() ? true : false;
            if ($hasSession) {
                return new DataFailed(
                    status: false,
                    statusCode: 400,
                    message: 'لايمكن حذف المجموعة ان كانت تحتوى علي حصص'
                );
            } elseif ($hasExam) {
                return new DataFailed(
                    status: false,
                    statusCode: 400,
                    message: 'لايمكن حذف المجموعة ان كانت تحتوى علي امتحانات'
                );
            } else {
                $group->delete();
                return new DataSuccess(
                    status: true,
                    message: 'تم حذف المجموعة بنجاح'
                );
            }
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function change_group_active_status($request): DataStatus
    {
        try {
            $group = Group::find($request->id);
            if ($group->status == 1) {
                $group->status = 0;
            } else {
                $group->status = 1;
            }
            $group->save();
            return new DataSuccess(
                data: new GroupResource($group),
                status: true,
                message: 'Group status updated successfully'
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
