<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityRequest;
use App\Http\Resources\CityResource;
use App\Services\CityService;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index()
    {
        return $this->cityService->getAllCities()->response();
       // return CityResource::collection($cities);
    }

    public function store(CityRequest $request)
    {
        return $this->cityService->createCity($request->validated())->response();
    }

    public function show($id)
    {
        $city = $this->cityService->getCityById($id);
        return new CityResource($city);
    }

    public function update(CityRequest $request, $id)
    {
        return $this->cityService->updateCity($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->cityService->deleteCity($id)->response();
    }
}


