<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Opinion\FetchOpinionService;

class FetchOpinionController  extends Controller
{

    public function __construct(protected FetchOpinionService $fetchOpinionService) {}

    public function __invoke()
    {
        return $this->fetchOpinionService->fetchOpinions()->response();
    }
}
