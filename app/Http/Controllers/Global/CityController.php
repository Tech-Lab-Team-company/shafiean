<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\AddCityRequest;
use App\Http\Requests\City\CityRequest;
use App\Http\Requests\City\DeleteCityRequest;
use App\Http\Requests\City\EditCityRequest;
use App\Http\Requests\City\FetchCitiesRequest;
use App\Http\Requests\City\FetchCityDetailsRequest;
use App\Http\Resources\CityResource;
use App\Services\CityService;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index(FetchCitiesRequest $request)
    {
        return $this->cityService->getAllCities($request)->response();
    }

    public function store(AddCityRequest $request)
    {
        return $this->cityService->createCity($request)->response();
    }

    public function show(FetchCityDetailsRequest $request)
    {
        return $this->cityService->getCityById($request)->response();
    }

    public function update(EditCityRequest $request)
    {
        return $this->cityService->updateCity( $request)->response();
    }

    public function destroy(DeleteCityRequest $request)
    {
        return $this->cityService->deleteCity($request)->response();
    }
}
