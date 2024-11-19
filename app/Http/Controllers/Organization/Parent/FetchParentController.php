<?php

namespace App\Http\Controllers\Organization\Parent;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\User\FetchUserService;
use App\Services\Organization\EndPoint\Parent\FetchParentService;

class FetchParentController extends Controller
{
    public function __construct(protected FetchParentService $fetchParentService) {}
    public function __invoke()
    {
        return $this->fetchParentService->fetchParents()->response();
    }
}
