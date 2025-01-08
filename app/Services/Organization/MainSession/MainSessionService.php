<?php

namespace App\Services\Organization\MainSession;


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

class MainSessionService
{
    public function index($dataRequest, $auth): DataStatus
    {
        try {
            // $query = MainSession::query();
            // $filter_service = new FilterService();
            // if ($dataRequest) {
            //     $filter_service->filterMainSession($dataRequest, $query);
            // }
            // $mainSessions = $query->orderBy('id', 'desc')->paginate(10);
            $mainSession = GroupStageSession::where('group_id', $dataRequest->group_id)->paginate(10);
            // $mainSessions = MainSession::whereOrganizationId($auth->organization_id)->whereIn("id", $mainSessionIds)->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: FetchMainSessionIndexForGroupResource::collection($mainSession)->response()->getData(true),
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
    public function create($dataRequest): DataStatus
    {
        try {
            $groupStage = $this->storeGroupStage($dataRequest->group_id,  $dataRequest->stage_id);
            $data['title'] = $dataRequest->is_new == SessionIsNewEnum::NEW->value ? $dataRequest->title : MainSession::find($dataRequest->session_id)?->title;
            $data['session_id'] = $dataRequest->is_new == SessionIsNewEnum::EXISTS->value ? $dataRequest->session_id : null;
            $data['teacher_id'] = $dataRequest->teacher_id;
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
            /* $mainSession = */
            GroupStageSession::create($data);
            // $this->storeGroupStageSessions($mainSession, $dataRequest->group_id, $dataRequest->stage_id, $dataRequest->session_type_id);
            return new DataSuccess(
                /* data: new MainSessionResource($mainSession), */
                status: true,
                message: 'Main session created successfully'
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
            $mainSession = MainSession::find($request->id);
            return new DataSuccess(
                data: new MainSessionResource($mainSession),
                status: true,
                message: 'Main session retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function update($request): DataStatus
    {
        try {
            $mainSession = MainSession::find($request->id);
            $data['title'] = $request->title;
            $data['stage_id'] = $request->stage_id;
            $data['surah_id'] = $request->surah_id;
            $data['session_type_id'] = $request->session_type_id;
            $data['start_ayah_id'] = $request->start_ayah_id;
            $data['end_ayah_id'] = $request->end_ayah_id;
            $mainSession->update($data);
            return new DataSuccess(
                data: new MainSessionResource($mainSession),
                status: true,
                message: 'Main session updated successfully'
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
            $mainSession = MainSession::find($request->id);
            $mainSession->delete();
            return new DataSuccess(
                status: true,
                message: 'Main session deleted successfully'
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
                message: 'Main session status changed successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
