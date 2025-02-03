<?php

namespace App\Services;

use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\SessionTypeResource;
use App\Models\SessionType;
use App\Services\Global\FilterService;
use Exception;

class SessionTypeService
{
    public function getAll($request): DataStatus
    {
        try {
            $query = SessionType::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterSessionType($request, $query);
            }
            $sessiontypes = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                status: true,
                data: SessionTypeResource::collection($sessiontypes)->response()->getData(true),
                message: 'Session types fetched successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function create($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['organization_id'] = $request->organization_id;
            $sessiontype = SessionType::create($data);
            return new DataSuccess(
                status: true,
                data: new SessionTypeResource($sessiontype),
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function getDetails($request): DataStatus
    {
        try {
            $sessiontype = SessionType::find($request->id);
            return new DataSuccess(
                status: true,
                data: new SessionTypeResource($sessiontype),
                message: 'Session type fetched successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function update($request): DataStatus
    {
        try {
            $sessiontype = SessionType::find($request->id);
            $data['title'] = $request->title ?? $sessiontype->title;
            $data['organization_id'] = $request->organization_id ?? $sessiontype->organization_id;
            $sessiontype->update($data);
            return new DataSuccess(
                status: true,
                data: new SessionTypeResource($sessiontype),
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function delete($request): DataStatus
    {
        try {
            $sessiontype = SessionType::find($request->id);
            $sessiontype->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function changeActiveStatus($request): DataStatus
    {
        try {
            $sessiontype = SessionType::find($request->id);
            if ($sessiontype->status == 1) {
                $sessiontype->status = 0;
            } else {
                $sessiontype->status = 1;
            }
            $sessiontype->save();
            return new DataSuccess(
                status: true,
                data: new SessionTypeResource($sessiontype),
                message: __('messages.success_change_status')
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
