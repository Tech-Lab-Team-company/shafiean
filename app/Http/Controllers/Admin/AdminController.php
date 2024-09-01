<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {

        return $this->adminService->getAll()->response();
    }

    public function store(AdminStoreRequest $request)
    {
        return $this->adminService->create($request)->response();
    }

    public function show(Request $request)
    {
        return $this->adminService->getById($request)->response();
    }

    public function update(AdminUpdateRequest $request)
    {
        return $this->adminService->update($request->validated())->response();
    }

    public function destroy(Request $request)
    {
        return $this->adminService->delete($request)->response();
    }
}
