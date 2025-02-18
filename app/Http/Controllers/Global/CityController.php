<?php

namespace App\Http\Controllers\Global;

use App\Services\CityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Requests\City\CityRequest;
use App\Http\Requests\City\AddCityRequest;
use App\Http\Requests\City\EditCityRequest;
use App\Http\Requests\City\DeleteCityRequest;
use App\Http\Requests\City\FetchCitiesRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\City\FetchCityDetailsRequest;

class CityController extends Controller /* implements HasMiddleware */
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    // public static function middleware(): array
    // {
    //     return [
    //         'auth',
    //         new Middleware('permission:cities-create', only: ['create', 'store']),
    //         // new Middleware('permission:cities-read', only: ['index', 'show']),
    //     ];
    // }

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
        return $this->cityService->updateCity($request)->response();
    }

    public function destroy(DeleteCityRequest $request)
    {
        return $this->cityService->deleteCity($request)->response();
    }
}
