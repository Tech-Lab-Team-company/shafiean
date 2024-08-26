<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\County\CountryRequest;
use App\Services\CountryService;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        return $this->countryService->getAllCountries()->response();
    }

    public function store(CountryRequest $request)
    {
        return $this->countryService->createCountry($request->validated())->response();
    }

    public function show($id)
    {
        return $this->countryService->getCountryById($id)->response();
    }

    public function update(CountryRequest $request, $id)
    {
        return $this->countryService->updateCountry($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->countryService->deleteCountry($id)->response();
    }
}
