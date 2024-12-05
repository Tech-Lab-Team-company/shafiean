<?php


namespace App\Services\Parent;

use App\Models\User;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\UserNameResource;
use App\Http\Resources\Parent\Child\ChildResource;
use App\Http\Resources\Parent\Exam\ChildExamResource;
use App\Http\Resources\Parent\Exam\FetchChildExamResource;
use App\Http\Resources\Parent\Child\ChildAttendanceResource;
use App\Http\Resources\Parent\Session\ChildSessionAttendanceResource;

class ChildService
{
    public function academic_report($request): DataStatus
    {
        try {
            $parent = auth()->guard('user')->user();
            $children = $parent->childs()->paginate(10);
            // dd($children);
            return new DataSuccess(
                data: ChildResource::collection($children)->response()->getData(true),
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
        // try {
        /**
         * @var User
         */
        $parent = Auth::guard('user')->user();
        $children = $parent->childs()->where('users.id', $request->student_id)->orderBy('id', 'desc')->first();
        $childId = $children->id;
        $exams = $children->exams;
        return new DataSuccess(
            data: ChildExamResource::collection($exams)->map(function ($exam) use ($childId, $children) {
                return (new ChildExamResource($exam))->additional(['child_id' => $childId]);
            }),
            status: true,
            message: 'success',
        );
        // } catch (\Exception $e) {
        //     return new DataFailed(
        //         status: false,
        //         message: $e->getMessage()
        //     );
        // }
    }
    // public function exam_report($request): DataStatus
    // {
    //     try {
    //         /**
    //          * @var User
    //          */
    //         $parent = auth()->guard('user')->user();
    //         if (isset($request->student_id)) {
    //             $children = $parent->childs()->where('users.id', $request->student_id)->get();
    //         } else {
    //             $children = $parent->childs;
    //         }
    //         // dd($children);
    //         return new DataSuccess(
    //             data: FetchChildExamResource::collection($children),
    //             status: true,
    //             message: 'success',
    //         );
    //     } catch (\Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }
    public function session_attendance_report($request): DataStatus
    {
        try {
            // /**
            //  * @var User
            //  */
            $parent = auth()->guard('user')->user();
            $children = $parent->childs()->paginate(10);
            // dd($children);
            $groups = $children->map(function ($child) {
                return [
                    'child_id' => $child->id,
                    'group_ids' => $child->subscripe_groups()->pluck('group_id')->toArray(),
                ];
                // return  $child->subscripe_groups()->pluck('group_id')->toArray();
            });
            $sessions = GroupStageSession::whereIn('group_id', $groups[0]['group_ids'])->orderBy('id', 'desc')->get();
            // dd($children);
            $childId = $groups[0]['child_id'];
            // dd($childId);
            return new DataSuccess(
                // data: ChildAttendanceResource::collection($children),
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
                data: UserNameResource::collection($children),
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
