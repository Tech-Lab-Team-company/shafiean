<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\YearResource;
use App\Models\Year;
use App\Services\Global\FilterService;
use Exception;

class YearService
{
    public function getAll($request): DataStatus
    {
        try {
            $query = Year::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterYear($request, $query);
            }
            $years = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                status: true,
                data: YearResource::collection($years)->response()->getData(true),
                message: 'Years retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function store($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['country_id'] = $request->country_id;
            $year = Year::create($data);
            return new DataSuccess(
                status: true,
                data: new YearResource($year),
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
            $year = Year::find($request->id);
            return new DataSuccess(
                status: true,
                data: new YearResource($year),
                message: 'Year fetched successfully'
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
            $year = Year::find($request->id);
            $data['title'] = $request->title ?? $year->title;
            $data['country_id'] = $request->country_id ?? $year->country_id;
            $year->update($data);
            return new DataSuccess(
                status: true,
                data: new YearResource($year),
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function destroy($request): DataStatus
    {
        try {
            $year = Year::find($request->id);
            $year->delete();
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
            $year = Year::find($request->id);
            if ($year->status == 0) {
                $year->status = 1;
            } else {
                $year->status = 0;
            }
            $year->save();
            return new DataSuccess(
                status: true,
                data: new YearResource($year),
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
