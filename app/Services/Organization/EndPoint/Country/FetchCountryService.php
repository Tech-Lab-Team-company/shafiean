<?php
namespace App\Services\Organization\EndPoint\Country;


use Exception;
use App\Models\Country;
use App\Models\BloodType;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\EndPoint\Country\FetchCountryResource;
use App\Http\Resources\Organization\EndPoint\BloodType\FetchBloodTypeResource;

class FetchCountryService
{
    public function fetchCountries()
    {
        try {
            $countries = Country::get();
            return new DataSuccess(
                data: FetchCountryResource::collection($countries),
                status: true,
                message: 'Fetch Countries successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
