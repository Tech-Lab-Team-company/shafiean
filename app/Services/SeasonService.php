<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Services\Global\FilterService;
use Exception;

class SeasonService
{
    public function getAll($request): DataStatus
    {
        try {
            $query = Season::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterSeason($request, $query);
            }
            $seasons = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: SeasonResource::collection($seasons)->response()->getData(true),
                status: true,
                message: 'Seasons retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: true,
                message: $e->getMessage()
            );
        }
    }

    public function store($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['country_id'] = $request->country_id;
            $season = Season::create($data);
            return new DataSuccess(
                data: new SeasonResource($season),
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
            $season = Season::find($request->id);
            return new DataSuccess(
                data: new SeasonResource($season),
                status: true,
                message: 'Season retrieved successfully'
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
            $season = Season::find($request->id);
            $data['title'] = $request->title ?? $season->title;
            $data['country_id'] = $request->country_id ?? $season->country_id;
            $season->update($data);
            return new DataSuccess(
                data: new SeasonResource($season),
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
            $season = Season::find($request->id);
            $season->delete();
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
            $season = Season::find($request->id);
            if ($season->status == 1) {
                $season->status = 0;
            } else {
                $season->status = 1;
            }
            $season->save();
            return new DataSuccess(
                data: new SeasonResource($season),
                status: true,
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
