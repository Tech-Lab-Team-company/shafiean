<?php

namespace App\Http\Controllers\Organization\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Role\MapService;
use App\Http\Requests\Organization\Role\Map\StoreMapRequest;

class MapController extends Controller
{
    public function __construct(protected MapService $mapService) {}

    public function fetchAllMaps()
    {
        return $this->mapService->fetchAllMaps()->response();
    }
    public function store(StoreMapRequest $request)
    {
        return $this->mapService->store($request)->response();
    }
}
