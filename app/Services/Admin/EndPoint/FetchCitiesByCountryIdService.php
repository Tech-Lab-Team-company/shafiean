<?php

namespace App\Services\Admin\EndPoint;


use Exception;
use App\Models\City;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\SimpleCityResource;

class FetchCitiesByCountryIdService
{
    public function fetchCities($dataRequest)
    {
        try {
            $cities  = City::Where('country_id',$dataRequest->country_id)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: SimpleCityResource::collection($cities),
                status: true,
                message: 'Fetch Cities successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
