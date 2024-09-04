<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Services\Global\FilterService;
use Exception;

class CityService
{
    public function getAllCities($request)
    {
        try {
            $query = City::query();
            $filter_service = new FilterService();
            if ($request) {
                // dd($request);
                $filter_service->filterCities($request, $query);
            }
            $cities = $query->orderBy('id', 'desc')->paginate(10);

            return new DataSuccess(
                data: CityResource::collection($cities)->response()->getData(true),
                status: true,
                message: 'Cities retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: 'Failed to retrieve cities: ' . $e->getMessage()
            );
        }
    }

    public function createCity($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['country_id'] = $request->country_id;
            $city = City::create($data);

            return new DataSuccess(
                data: new CityResource($city),
                status: true,
                message: 'City created successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                status: false,
                message: 'City creation failed: ' . $e->getMessage()
            );
        }
    }

    public function getCityById($request): DataStatus
    {
        try {
            $city = City::find($request->id);

            return new DataSuccess(
                data: new CityResource($city),
                status: true,
                message: 'City retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'City not found: ' . $e->getMessage()
            );
        }
    }

    public function updateCity($request): DataStatus
    {
        try {
            $city = City::find($request->id);
            $data['title'] = $request->title;
            $data['country_id'] = $request->country_id;
            $city->update($data);

            return new DataSuccess(
                data: new CityResource($city),
                status: true,
                message: 'City updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'City update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCity($request): DataStatus
    {
        try {

            $city = City::find($request->id);
            // dd($city);
            $city->delete();

            return new DataSuccess(
                status: true,
                message: 'City deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'City deletion failed: ' . $e->getMessage()
            );
        }
    }


 
}
