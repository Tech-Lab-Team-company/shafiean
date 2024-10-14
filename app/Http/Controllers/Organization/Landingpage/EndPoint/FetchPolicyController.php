<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Policy\FetchPolicyService;

class FetchPolicyController  extends Controller
{

    public function __construct(protected FetchPolicyService  $fetchPolicyService) {}

    public function __invoke()
    {
        return $this->fetchPolicyService->fetchPolicy()->response();
    }
}
