<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Partner\FetchPartnerService;

class FetchPartnerController  extends Controller
{

    public function __construct(protected FetchPartnerService $fetchPartnerService) {}

    public function __invoke()
    {
        return $this->fetchPartnerService->fetchPartners()->response();
    }
}
