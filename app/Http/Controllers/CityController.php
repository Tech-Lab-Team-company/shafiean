<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index()
    {
        $cities = $this->cityService->getAllCities();
        return CityResource::collection($cities);
    }

    public function store(CityRequest $request)
    {
        $city = $this->cityService->createCity($request->validated());
        return new CityResource($city);
    }

    public function show($id)
    {
        $city = $this->cityService->getCityById($id);
        return new CityResource($city);
    }

    public function update(CityRequest $request, $id)
    {
        $city = $this->cityService->updateCity($id, $request->validated());
        return new CityResource($city);
    }

    public function destroy($id)
    {
        $this->cityService->deleteCity($id);
        return response()->json(['message' => 'City deleted successfully']);
    }
}

