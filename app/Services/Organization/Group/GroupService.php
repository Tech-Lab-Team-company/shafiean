<?php

namespace App\Services\Organization\Group;

use Exception;
use Carbon\Carbon;
use App\Models\Group;
use App\Models\Course;
use App\Models\GroupStage;
use App\Enum\HasCourseEnum;
use App\Models\MainSession;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\GroupResource;
use App\Services\Global\FilterService;

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
                data: GroupResource::collection($groups)->response()->getData(true),
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
        $organizationId = get_organization_id(auth()->guard('organization')->user());
        foreach ($groupStages as $stage) {
            foreach ($mainSessions as $session) {
                GroupStageSession::create([
                    'group_stage_id' => $group->id,
                    'session_id' => $session->id,
                    'organization_id' => $organizationId,
                    'group_id' => $group->id,
                    'stage_id' => $stage->stage_id,
                    'session_type_id' => $session->session_type_id,
                    'start_verse' => $session->start_verse,
                    'end_verse' => $session->end_verse,
                ]);
            }
        }
    }
    public function add_group($request): DataStatus
    {
        // try {
            $group = Group::create([
                'title' => $request->title,
                'course_id' => $request->course_id,
                'teacher_id' => $request->teacher_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'with_all_disability' => $request->with_all_disability,
                'with_all_course_content' => $request->with_all_course_content,
            ]);
            if ($request->days) {
                foreach ($request->days as $day) {
                    $group->days()->attach($day['day_id'], ['start_time' => $day['start_time'], 'end_time' => $day['end_time']]);
                }
            }

            if ($request->disabilities) {
                $group->disabilities()->attach($request->disabilities, ['course_id' => $request->course_id]);
            }
            if ($request->with_all_course_content == HasCourseEnum::HAS_COURSE->value) {
                $courseStages = Course::find($request->course_id)->stages;
                $stageIds = $courseStages->pluck('id')->toArray();
                $mainSessions = MainSession::whereIn('stage_id', $stageIds)->get();
                $group->stages()->attach($stageIds);
            } else {
                $mainSessions = MainSession::whereIn('stage_id', $request->stages)->get();
                $group->stages()->attach($request->stages);
            }
            $groupStages = GroupStage::where('group_id', $group->id)->get();
            $this->storeGroupStageSessions($groupStages, $mainSessions, $group);
            return new DataSuccess(
                data: new GroupResource($group),
                status: true,
                message: 'Group created successfully'
            );
        // } catch (Exception $exception) {
            // return new DataFailed(
                // status: false,  // false
                // message: $exception->getMessage()
            // );
        // }
    }

    public function fetch_group_details($request): DataStatus
    {
        try {
            $group = Group::find($request->id);
            return new DataSuccess(
                data: new GroupResource($group),
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
                'title' => $request->title ?? $group->title,
                'course_id' => $request->course_id ?? $group->course_id,
                'teacher_id' => $request->teacher_id ?? $group->teacher_id,
                'start_date' => isset($request->start_date) ? Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : $group->start_date,
                'end_date' => isset($request->end_date) ?  Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : $group->end_date,
                'start_time' => isset($request->start_time) ? Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s') : $group->start_time,
                'end_time' => isset($request->end_time) ? Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s') : $group->end_time,
                'with_all_disability' => $request->with_all_disability ?? $group->with_all_disability,
                'with_all_course_content' => $request->with_all_course_content ?? $group->with_all_course_content,
            ]);
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
            $group->delete();
            return new DataSuccess(
                status: true,
                message: 'Group deleted successfully'
            );
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
