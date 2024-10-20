<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\EditPasswordRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index(Request $request)
    {

        return $this->adminService->getAll($request)->response();
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
        return $this->adminService->update($request)->response();
    }

    public function destroy(DeleteRequest $request)
    {
        return $this->adminService->delete($request)->response();
    }

    public function EditPassword(EditPasswordRequest $request)
    {
        return $this->adminService->editPassword($request)->response();
    }
}
