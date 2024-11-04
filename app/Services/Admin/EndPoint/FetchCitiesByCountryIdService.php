<?php

namespace App\Services\Admin\EndPoint;


use Exception;
use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Teacher;
use Carbon\CarbonPeriod;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\SimpleCityResource;
use App\Http\Resources\Admin\Statistics\Count\AdminHomeCountStatisticResource;
use App\Http\Resources\Admin\Statistics\Student\LatestStudentStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\InteractedRateWithOrganizationResource;
use App\Http\Resources\Admin\Statistics\Organization\MostActiveOrganizationStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\BestPlacesInteractedWithOrganizationStatisticResource;

class FetchCitiesByCountryIdService
{
    public function fetchCities($dataRequest)
    {
        try {
            $cities  = City::Where('country_id',$dataRequest->country_id)->get();
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
