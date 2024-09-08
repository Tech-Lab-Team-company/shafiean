<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\AddCountryRequest;
use App\Http\Requests\Country\DeleteCountryRequest;
use App\Http\Requests\Country\EditCountryRequest;
use App\Http\Requests\Country\FetchCountriesRequest;
use App\Http\Requests\Country\FetchCountryDetailsRequest;
use App\Http\Requests\County\CountryRequest;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(FetchCountriesRequest $request)
    {
        return $this->countryService->getAllCountries($request)->response();
    }

    public function store(AddCountryRequest $request)
    {
        return $this->countryService->createCountry($request)->response();
    }

    public function show(FetchCountryDetailsRequest $request)
    {
        return $this->countryService->getCountryById($request)->response();
    }

    public function update(EditCountryRequest $request)
    {
        return $this->countryService->updateCountry($request)->response();
    }

    public function destroy(DeleteCountryRequest $request)
    {
        return $this->countryService->deleteCountry($request)->response();
    }
}
