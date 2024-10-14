<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Privacy\FetchPrivacyService;

class FetchPrivacyController  extends Controller
{

    public function __construct(protected FetchPrivacyService $fetchPrivacyService) {}

    public function __invoke()
    {
        return $this->fetchPrivacyService->fetchPrivacy()->response();
    }
}
