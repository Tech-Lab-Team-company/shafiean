<?php

namespace App\Http\Controllers\Organization\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Role\MapService;

class MapController extends Controller
{
    public function __construct(protected MapService $mapService) {}

    public function store(Request $request)
    {
        return $this->mapService->store($request)->response();
    }
}
