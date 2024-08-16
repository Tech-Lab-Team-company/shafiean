<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {

        $countries = $this->countryService->getAllCountries();
        return CountryResource::collection($countries);
    }

    public function store(CountryRequest $request)
    {
        $country = $this->countryService->createCountry($request->validated());
        return new CountryResource($country);
    }

    public function show($id)
    {
        $country = $this->countryService->getCountryById($id);
        return new CountryResource($country);
    }

    public function update(CountryRequest $request, $id)
    {

        $country = $this->countryService->updateCountry($id, $request->validated());
        return new CountryResource($country);
    }

    public function destroy($id)
    {
        $this->countryService->deleteCountry($id);
        return response()->json(['message' => 'Country deleted successfully']);
    }
}

