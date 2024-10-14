<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Statistic\FetchStatisticService;

class FetchStatisticController extends Controller
{

    public function __construct(protected FetchStatisticService $fetchStatisticService) {}

    public function __invoke()
    {
        return $this->fetchStatisticService->fetchStatistics()->response();
    }
}
