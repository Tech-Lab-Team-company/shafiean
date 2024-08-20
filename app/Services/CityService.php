<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CityResource;
use App\Models\City;
use Exception;

class CityService
{
    public function getAllCities()
    {
        try {
            $cities = City::all();

            return new DataSuccess(
                data: CityResource::collection($cities),
                statusCode: 200,
                message: 'Cities retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                statusCode: 500,
                message: 'Failed to retrieve cities: ' . $e->getMessage()
            );
        }
    }

    public function createCity(array $data): DataStatus
    {
        try {
            $city = City::create($data);

            return new DataSuccess(
                data: new CityResource($city),
                statusCode: 200,
                message: 'City created successfully'
            );
        } catch (Exception $e) {
            return new DataStatus(
                statusCode: 500,
                message: 'City creation failed: ' . $e->getMessage()
            );
        }
    }

    public function getCityById($id): DataStatus
    {
        try {
            $city = City::find($id);

            return new DataSuccess(
                data: new CityResource($city),
                statusCode: 200,
                message: 'City retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'City not found: ' . $e->getMessage()
            );
        }
    }

    public function updateCity($id, array $data): DataStatus
    {
        try {
            $city = City::find($id);
            $city->update($data);

            return new DataSuccess(
                data: new CityResource($city),
                statusCode: 200,
                message: 'City updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'City update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCity($id): DataStatus
    {
        try {
            $city = City::find($id);
            $city->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'City deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'City deletion failed: ' . $e->getMessage()
            );
        }
    }
}


