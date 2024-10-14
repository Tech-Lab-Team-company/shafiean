<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\SubHeader\FetchSubHeaderService;

class FetchSubHeaderController extends Controller
{

    public function __construct(protected FetchSubHeaderService $fetchSubHeaderService) {}

    public function __invoke()
    {
        return $this->fetchSubHeaderService->fetchSubHeaders()->response();
    }
}
