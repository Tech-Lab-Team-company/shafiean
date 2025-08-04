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
use App\Models\Surah\Surah;
use App\Enum\ReportTypeEnum;
use App\Http\Resources\Organization\AttendenceReport\AttendenceReportDetailsResource;
use App\Http\Resources\Organization\AttendenceReport\AttendenceReportResource;
use App\Models\AttendenceReport\AttendenceReport;
use App\Models\Report\Report;
use Illuminate\Support\Facades\DB;

class AttendenceReportService 
{
    public function index($dataRequest, $auth): DataStatus
    {
        try {
            $reports = AttendenceReport::when($dataRequest->has('word') && !empty($dataRequest->word), function ($q) use ($dataRequest) {
                return $q->whereHas('user', function ($subq) use ($dataRequest) {
                    $subq->where('name', 'like', '%' . $dataRequest->word . '%');
                })/* ->orWhereHas('teacher', function ($subq2) use ($dataRequest) {
                    $subq2->where('name', 'like', '%' . $dataRequest->word . '%');
                }) */;
            });
            $data =  $reports
                ->orderBy('order_by', 'asc')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
            return new DataSuccess(
                data: AttendenceReportResource::collection($data)->response()->getData(true),
                message: 'All Reports retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function create(object $dataRequest): DataStatus
    {
        DB::beginTransaction();
        try {
            $teacher_id = $dataRequest->teacher_id ?? auth('organization')->user()->id;
            $report_id = $dataRequest->report_id ?? $this->handleCreateReport($dataRequest,$teacher_id);

            $order = $dataRequest->order_by ?? AttendenceReport::where('report_id', $report_id)->max('order_by') + 1;
            $data['order_by'] = $order;
            $data['user_id'] = $dataRequest->user_id;
            $data['is_absent'] = $dataRequest->is_absent ?? false;
            $data['teacher_id'] = $teacher_id;
            $data['date'] = $dataRequest->date;
            $data['notes'] = $dataRequest->notes;
            $data['report_id'] = $report_id;
            // dd($data,$dataRequest);
            $report = AttendenceReport::create($data);
            DB::commit();
            return new DataSuccess(
                data: new AttendenceReportResource($report),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            DB::rollBack();
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function createMutiple(object $dataRequest): DataStatus
    {
        DB::beginTransaction();
        try {
            $createReportData = (object)[];
            $teacher_id = $dataRequest->teacher_id ?? auth('organization')->user()->id;
            $report_id = $dataRequest->report_id ?? $this->handleCreateReport($dataRequest,$teacher_id);
            $createReportData->report_id = $report_id;
            $createReportData->teacher_id = $teacher_id;
            $order = AttendenceReport::where('report_id', $report_id)->max('order_by') ?? 1;
            foreach ($dataRequest->reports as $reportData) {
                $reportData = (object)$reportData;
                $createReportData->user_id = $reportData->user_id ?? null;
                $createReportData->is_absent = $reportData->is_absent ?? false;
                $createReportData->notes = $reportData->notes ?? null;
                $createReportData->date = $reportData->date ?? null;
                $createReportData->order_by = $order;
                $this->create($createReportData);
                $order++;
            }
            DB::commit();
            return new DataSuccess(
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            DB::rollBack();
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    private function handleCreateReport($dataRequest, $teacher_id):?int
    {   
        $data = [
            'group_id' => $dataRequest->group_id,
            'stage_id' => $dataRequest->stage_id,
            'session_id' => $dataRequest->session_id,
            'teacher_id' => $teacher_id,
            'date' => $dataRequest->date,
            'type' => ReportTypeEnum::ATTENDENCE->value
        ];
        $report = Report::create($data);
        if ($report) {
            return $report->id;
        }
        return null;
    }
    public function getDetails($request): DataStatus
    {
        try {
            $report = AttendenceReport::find($request->report_id);
            return new DataSuccess(
                data: new AttendenceReportDetailsResource($report),
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


    public function delete($request): DataStatus
    {
        try {
            $report = AttendenceReport::find($request->report_id);
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
}
