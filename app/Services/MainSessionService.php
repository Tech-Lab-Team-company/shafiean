<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\MainSessionResource;
use App\Models\MainSession;
use App\Services\Global\FilterService;
use Exception;

class MainSessionService
{
    public function getAll($request): DataStatus
    {
        try {
            $query = MainSession::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterMainSession($request, $query);
            }
            $mainSessions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: MainSessionResource::collection($mainSessions)->response()->getData(true),
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

    public function create($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['stage_id'] = $request->stage_id;
            $data['surah_id'] = $request->surah_id;
            $data['session_type_id'] = $request->session_type_id;
            $data['start_ayah_id'] = $request->start_ayah_id;
            $data['end_ayah_id'] = $request->end_ayah_id;
            $mainSession = MainSession::create($data);
            return new DataSuccess(
                data: new MainSessionResource($mainSession),
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
            $data['title'] = $request->title ?? $mainSession->title;
            $data['stage_id'] = $request->stage_id ?? $mainSession->stage_id;
            $data['quraan_id'] = $request->quraan_id ?? $mainSession->quraan_id;
            $data['session_type_id'] = $request->session_type_id ?? $mainSession->session_type_id;
            $data['start_verse'] = $request->start_verse ?? $mainSession->start_verse;
            $data['end_verse'] = $request->end_verse ?? $mainSession->end_verse;
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
