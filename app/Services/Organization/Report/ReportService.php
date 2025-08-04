<?php

namespace App\Services\Organization\Report;

use Exception;
use App\Models\GroupStage;
use App\Models\MainSession;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Report\ReportDetailsResource;
use App\Services\Global\FilterService;
use App\Http\Resources\Organization\Report\ReportResource;
use App\Models\Ayah;
use App\Models\Report\Report;
use App\Models\Surah\Surah;
use App\Enum\ReportTypeEnum;

class ReportService
{
    public function index($dataRequest, $auth): DataStatus
    {
        try {
            $reports = Report::when($dataRequest->has('word') && !empty($dataRequest->word), function ($q) use ($dataRequest) {
                return $q->whereHas('user', function ($subq) use ($dataRequest) {
                    $subq->where('name', 'like', '%' . $dataRequest->word . '%');
                })->orWhereHas('teacher', function ($subq2) use ($dataRequest) {
                    $subq2->where('name', 'like', '%' . $dataRequest->word . '%');
                });
            });
            $data =  $reports
                ->orderBy('order_by', 'asc')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
            return new DataSuccess(
                data: ReportDetailsResource::collection($data)->response()->getData(true),
                message: 'All Reports retrieved successfully'
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
    public function create($dataRequest): DataStatus
    {
        try {
            // $groupStage = $this->storeGroupStage($dataRequest->group_id,  $dataRequest->stage_id);
            // $data['group_stage_id'] = $groupStage->id;
            $data['user_id'] = $dataRequest->user_id;
            $data['degree'] = $dataRequest->degree;
            $data['is_absent'] = $dataRequest->is_absent ?? false;
            $data['teacher_id'] = $dataRequest->teacher_id ?? auth('organization')->user()->id;
            $data['session_id'] = $dataRequest->session_id;
            $data['group_id'] = $dataRequest->group_id;
            $data['stage_id'] = $dataRequest->stage_id;
            $data['session_type_id'] = $dataRequest->session_type_id;
            $data['type'] = $dataRequest->type;
            $data['date'] = $dataRequest->date;
            $data['notes'] = $dataRequest->notes;
            $createData = array_merge($data,$this->handleCreateReportable($dataRequest, $data));
            $report = Report::create($createData);
            return new DataSuccess(
                data: new ReportResource($report),
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
    private function handleCreateReportable($dataRequest, $data=[]):array
    {
        if($dataRequest->type == ReportTypeEnum::QURAAN->value){
            $data['from_reportable_type'] = Surah::class;
            $data['from_reportable_id'] = $dataRequest->from_surah_id ?? null;

            $data['from_sub_reportable_type'] = Ayah::class;
            $data['from_sub_reportable_id'] = $dataRequest->from_ayah_id ?? null;

            $data['to_reportable_type'] = Surah::class;
            $data['to_reportable_id'] = $dataRequest->to_surah_id ?? null;

            $data['to_sub_reportable_type'] = Ayah::class;
            $data['to_sub_reportable_id'] = $dataRequest->to_ayah_id ?? null;
        }
        return $data;
    }
    public function getDetails($request): DataStatus
    {
        try {
            $report = Report::find($request->report_id);
            return new DataSuccess(
                data: new ReportDetailsResource($report),
                status: true,
                message: 'report retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function update($dataRequest): DataStatus
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
            $data['teacher_id'] = $dataRequest->teacher_id;
            $data['session_type_id'] = $dataRequest->session_type_id;
            $data['date'] = $dataRequest->date;
            $data['start_time'] = $dataRequest->start_time;
            $data['end_time'] = $dataRequest->end_time;
            $session->update($data);
            return new DataSuccess(
                data: new ReportResource($session),
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
            $report = Report::find($request->report_id);
            $report->delete();
            return new DataSuccess(
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
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
                data: new ReportResource($mainSession),
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
