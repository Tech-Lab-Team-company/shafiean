<?php

namespace App\Http\Controllers\Admin\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\EndPoint\FetchCitiesByCountryIdService;
use App\Http\Requests\Admin\EndPoint\FetchCitiesByCountryIdRequest;

class FetchCitiesByCountryIdController extends Controller

{
    function __construct(protected FetchCitiesByCountryIdService $fetchCitiesByCountryIdService) {}
    public function __invoke(FetchCitiesByCountryIdRequest $request)
    {
        return $this->fetchCitiesByCountryIdService->fetchCities($request)->response();
    }
}