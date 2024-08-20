<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Exception;

class CountryService
{
    public function getAllCountries(): DataStatus
    {
        try {
            $countries = Country::all();

            return new DataSuccess(
                data: CountryResource::collection($countries),
                statusCode: 200,
                message: 'Countries retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve countries: ' . $e->getMessage()
            );
        }
    }

    public function createCountry(array $data): DataStatus
    {
        try {
            $country = Country::create($data);

            return new DataSuccess(
                data: new CountryResource($country),
                statusCode: 201,
                message: 'Country created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Country creation failed: ' . $e->getMessage()
            );
        }
    }

    public function getCountryById($id): DataStatus
    {
        try {
            $country = Country::findOrFail($id);

            return new DataSuccess(
                data: new CountryResource($country),
                statusCode: 200,
                message: 'Country retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Country not found: ' . $e->getMessage()
            );
        }
    }

    public function updateCountry($id, array $data): DataStatus
    {
        try {
            $country = Country::findOrFail($id);
            $country->update($data);

            return new DataSuccess(
                data: new CountryResource($country),
                statusCode: 200,
                message: 'Country updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Country update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCountry($id): DataStatus
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'Country deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Country Was Deleted  '
            );
        }
    }
}
