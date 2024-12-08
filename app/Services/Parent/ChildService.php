<?php


namespace App\Services\Parent;

use App\Models\User;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\ExamResult;
use App\Http\Resources\ParentChildrenResource;
use App\Http\Resources\Parent\Child\ChildResource;
use App\Http\Resources\Parent\Exam\ChildExamResource;
use App\Http\Resources\Parent\Exam\LittleChildExamResource;
use App\Http\Resources\Parent\Child\ChildSessionTeacherReateResource;
use App\Http\Resources\Parent\Session\ChildSessionAttendanceResource;

class ChildService
{
    public function academic_report($request): DataStatus
    {
        try {
            /**
             * @var User
             */
            $parent = Auth::guard('user')->user();
            if (isset($request->child_id)) {
                $child = $parent->childs()->where('users.id', $request->child_id)->first()->received_rates;
            } else {
                $children = $parent->childs()->get();
            }
            return new DataSuccess(
                data: isset($children)  ? ChildResource::collection($children)->response()->getData(true) :  ChildSessionTeacherReateResource::collection($child),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function exam_report($request): DataStatus
    {
        try {
            /**
             * @var User
             */
            $parent = Auth::guard('user')->user();
            $childrenIds = [];
            $childId = null;
            if (isset($request->child_id)) {
                $children = $parent->childs()->where('users.id', $request->child_id)->orderBy('id', 'desc')->first();
                $childId = $children->id;
                $exams = $children->exams;
            } else {
                $childrenIds = $parent->childs()->pluck('users.id')->toArray();
                $exams = ExamResult::whereIn('user_id', $childrenIds)->get()->map(function ($exam) {
                    return $exam->exam;
                });
            }
            return new DataSuccess(
                data: ChildExamResource::collection($exams)->map(function ($exam) use ($childId, $childrenIds) {
                    return (new ChildExamResource($exam))->additional(['child_id' => $childId, 'children_ids' => $childrenIds]);
                }),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function littleExamReport($request): DataStatus
    {
        try {
            /**
             * @var User
             */
            $parent = Auth::guard('user')->user();
            $children = $parent->childs()->where('users.id', $request->child_id)->orderBy('id', 'desc')->first();
            $exams = $children->exams()->get();
            return new DataSuccess(
                data: LittleChildExamResource::collection($exams),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function session_attendance_report($request): DataStatus
    {
        try {
            /**
             * @var User
             */
            $parent = Auth::guard('user')->user();
            $groups = [];
            $sessions = [];
            $childId = null;
            if (isset($request->child_id)) {
                $child = $parent->childs()->where('users.id', $request->child_id)->first();
                $groups = $child->subscripe_groups()->pluck('group_id')->toArray();
                $sessions = GroupStageSession::whereIn('group_id', $groups)->orderBy('id', 'desc')->get();
                $childId = $child->id;
            } else {
                /**
                 * @var User
                 */
                $children = $parent->childs()->paginate(10);
                $groups = $children->map(function ($child) {
                    return [
                        'child_id' => $child->id,
                        'group_ids' => $child->subscripe_groups()->pluck('group_id')->toArray(),
                    ];
                });
                $sessions = GroupStageSession::whereIn('group_id', $groups[0]['group_ids'])->orderBy('id', 'desc')->get();
                $childId = $groups[0]['child_id'];
            }
            return new DataSuccess(
                data: ChildSessionAttendanceResource::collection($sessions)->map(function ($session) use ($childId) {
                    return (new ChildSessionAttendanceResource($session))->additional([
                        'child_id' => $childId
                    ]);
                }),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function parentChildren(): DataStatus
    {
        try {
            $parent = Auth::guard('user')->user();
            $children = $parent->childs;
            return new DataSuccess(
                data: ParentChildrenResource::collection($children),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function parentChildDetails($dataRequest): DataStatus
    {
        try {
            /**
             * @var User
             * */
            $parent = Auth::guard('user')->user();
            $children = $parent->childs()->where('users.id', $dataRequest->child_id)->first();
            return new DataSuccess(
                data: new  ParentChildrenResource($children),
                status: true,
                message: 'success',
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
