<?php

namespace App\Http\Controllers\Organization\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Role\ModuleService;
use App\Http\Requests\Organization\Role\Module\StoreModuleRequest;
use App\Http\Requests\Organization\Role\Module\DeleteModuleRequest;
use App\Http\Requests\Organization\Role\Module\UpdateModuleRequest;
use App\Http\Requests\Organization\Role\Module\FetchModuleDetailsRequest;

class ModuleController extends Controller
{
    public function __construct(protected ModuleService $moduleService) {}

    public function fetchAllModules()
    {
        return $this->moduleService->fetchAllModules()->response();
    }
    public function fetchModuleDetails(FetchModuleDetailsRequest $request)
    {
        return $this->moduleService->fetchModuleDetails($request)->response();
    }
    public function store(StoreModuleRequest $request)
    {
        return $this->moduleService->store($request)->response();
    }
    public function update(UpdateModuleRequest $request)
    {
        return $this->moduleService->update($request)->response();
    }
    public function delete(DeleteModuleRequest $request)
    {
        return $this->moduleService->delete($request)->response();
    }
}
