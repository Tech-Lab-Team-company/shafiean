<?php

namespace App\Http\Controllers\Organization\Country;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\Country\FetchCountryService;

class FetchCountryController extends Controller
{
    public function __construct(protected FetchCountryService $fetchCountryService) {}
    public function __invoke()
    {
        return $this->fetchCountryService->fetchCountries()->response();
    }
}
