<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Header\FetchHeaderService;

class FetchHeaderController extends Controller
{

    public function __construct(protected FetchHeaderService $fetchHeaderService) {}

    public function __invoke()
    {
        return $this->fetchHeaderService->fetchheaders()->response();
    }
}
