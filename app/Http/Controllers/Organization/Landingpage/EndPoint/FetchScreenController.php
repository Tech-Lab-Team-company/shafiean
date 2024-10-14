<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Screen\FetchScreenService;

class FetchScreenController  extends Controller
{

    public function __construct(protected FetchScreenService $fetchScreenService) {}

    public function __invoke()
    {
        return $this->fetchScreenService->fetchScreens()->response();
    }
}
