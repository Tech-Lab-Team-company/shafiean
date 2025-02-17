<?php

namespace App\Services\Teacher\Session;


use Exception;
use App\Models\Group;
use App\Models\Course;
use App\Models\GroupStage;
use App\Models\MainSession;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\MainSessionResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionIndexForGroupResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionDetailsForGroupResource;

class TeacherMainSessionService
{
    public function index($dataRequest, $auth): DataStatus
    {
        try {
            $query = GroupStageSession::where('group_id', $dataRequest->group_id);
            $mainSession = $query->when($dataRequest->has('word') && !empty($dataRequest->word), function ($q) use ($dataRequest) {
                return $q->whereHas('session', function ($q) use ($dataRequest) {
                    $q->where('title', 'like', '%' . $dataRequest->word . '%')
                        ->orwhereHas('teacher', function ($q) use ($dataRequest) {
                            $q->where('name', 'like', '%' . $dataRequest->word . '%');
                        });
                })->orWhere('title', 'like', '%' . $dataRequest->word . '%');
            });
            $data =  $mainSession
                ->orderBy('order_by', 'asc')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
            return new DataSuccess(
                data: FetchMainSessionIndexForGroupResource::collection($data)->response()->getData(true),
                status: true,
                message: 'Main sessions retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    private function storeGroupStage($groupId, $stageId)
    {
        return GroupStage::create([
            'group_id' => $groupId,
            'stage_id' => $stageId,
        ]);
    }
    private function storeGroupStageSessions($session, $groupId, $stageId, $sessionTypeId)
    {
        $groupStage = $this->storeGroupStage($groupId, $stageId);
        GroupStageSession::create([
            'group_stage_id' => $groupStage->id,
            'session_id' => $session->id,
            'group_id' => $groupId,
            'stage_id' => $stageId,
            'session_type_id' => $sessionTypeId,
            'start_verse' => (int) $session->start_verse,
            'end_verse' => (int) $session->end_verse,
        ]);
    }
    public function create($dataRequest, $auth): DataStatus
    {
        try {
            $groupStage = $this->storeGroupStage($dataRequest->group_id,  $dataRequest->stage_id);
            $data['title'] = $dataRequest->is_new == SessionIsNewEnum::NEW->value ? $dataRequest->title : MainSession::find($dataRequest->session_id)?->title;
            $data['session_id'] = $dataRequest->is_new == SessionIsNewEnum::EXISTS->value ? $dataRequest->session_id : null;
            $data['teacher_id'] = $auth->id;
            $data['group_stage_id'] = $groupStage->id;
            $data['stage_id'] = $dataRequest->stage_id;
            $data['group_id'] = $dataRequest->group_id;
            $data['session_type_id'] = $dataRequest->session_type_id;
            $data['surah_id'] = $dataRequest->surah_id;
            $data['start_ayah_id'] = $dataRequest->start_ayah_id;
            $data['end_ayah_id'] = $dataRequest->end_ayah_id;
            $data['date'] = $dataRequest->date;
            $data['start_time'] = $dataRequest->start_time;
            $data['end_time'] = $dataRequest->end_time;
            $data['is_offline'] = $dataRequest->is_offline;
            $data['with_edit'] = $dataRequest->is_new == SessionIsNewEnum::NEW->value ? 1 : 0;
            /* $mainSession = */
            GroupStageSession::create($data);
            // $this->storeGroupStageSessions($mainSession, $dataRequest->group_id, $dataRequest->stage_id, $dataRequest->session_type_id);
            return new DataSuccess(
                /* data: new MainSessionResource($mainSession), */
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function getDetails($request): DataStatus
    {
        try {
            $session = GroupStageSession::find($request->id);
            return new DataSuccess(
                data: new FetchMainSessionDetailsForGroupResource($session),
                status: true,
                message: 'session retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function update($dataRequest, $auth): DataStatus
    {
        try {
            $session = GroupStageSession::find($dataRequest->id);
            if ($session->with_edit == SessionIsNewEnum::NEW->value) {
                $data = [
                    'title' => $dataRequest->title,
                    'stage_id' => $dataRequest->stage_id,
                    'surah_id' => $dataRequest->surah_id,
                    'start_ayah_id' => $dataRequest->start_ayah_id,
                    'end_ayah_id' => $dataRequest->end_ayah_id
                ];
            }
            $data['teacher_id'] = $auth->id;
            $data['session_type_id'] = $dataRequest->session_type_id;
            $data['date'] = $dataRequest->date;
            $data['start_time'] = $dataRequest->start_time;
            $data['end_time'] = $dataRequest->end_time;
            $data['is_offline'] = $dataRequest->is_offline;
            $session->update($data);
            return new DataSuccess(
                data: new FetchMainSessionIndexForGroupResource($session),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }


    public function delete($request): DataStatus
    {
        try {
            $groupStageSession = GroupStageSession::find($request->id);
            $groupStageSession->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function changeActiveStatus($request): DataStatus
    {
        try {
            $mainSession = MainSession::find($request->id);
            if ($mainSession->status == 1) {
                $mainSession->status = 0;
            } else {
                $mainSession->status = 1;
            }
            $mainSession->save();
            return new DataSuccess(
                status: true,
                data: new MainSessionResource($mainSession),
                message: __('messages.success_change_status')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
