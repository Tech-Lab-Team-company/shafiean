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
    public function getAllCountries($request): DataStatus
    {
        try {
            if (isset($request->word)) {
                $countries = Country::where('title', 'like', '%' . $request->word . '%')->orderBy('id', 'desc')->paginate(10);
            } else {

                $countries = Country::orderBy('id', 'desc')->paginate(10);
            }

            return new DataSuccess(
                data: CountryResource::collection($countries)->response()->getData(true),
                status: true,
                message: 'Countries retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve countries: ' . $e->getMessage()
            );
        }
    }

    public function createCountry($request): DataStatus
    {
        try {
            $data['title'] = $request->title;
            $data['code'] = $request->code;
            $data['phone_code'] = $request->phone_code;
            $country = Country::create($data);

            return new DataSuccess(
                data: new CountryResource($country),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: true,
                message: 'Country creation failed: ' . $e->getMessage()
            );
        }
    }

    public function getCountryById($request): DataStatus
    {
        try {
            $country = Country::findOrFail($request->id);

            return new DataSuccess(
                data: new CountryResource($country),
                status: true,
                message: 'Country retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: true,
                message: 'Country not found: ' . $e->getMessage()
            );
        }
    }

    public function updateCountry($request): DataStatus
    {
        try {
            $country = Country::find($request->id);
            $data['title'] = $request->title ?? $country->title;
            $data['code'] = $request->code ?? $country->code;
            $data['phone_code'] = $request->phone_code ?? $country->phone_code;
            $country->update($data);

            return new DataSuccess(
                data: new CountryResource($country),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Country update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteCountry($request): DataStatus
    {
        try {
            $country = Country::find($request->id);
            $country->delete();

            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Country Was Deleted  '
            );
        }
    }
}
