<?php

namespace App\Http\Controllers\Organization\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Role\ModuleService;

class ModuleController extends Controller
{
    public function __construct(protected ModuleService $moduleService) {}

    public function store(Request $request)
    {
        return $this->moduleService->store($request)->response();
    }
}
