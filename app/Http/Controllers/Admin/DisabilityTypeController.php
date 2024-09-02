<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisabilityType\DestroyRequest;
use App\Http\Requests\DisabilityType\DisabilityTypeRequest;
use App\Http\Requests\DisabilityType\ShowRequest;
use App\Services\DisabilityTypeService;
use Illuminate\Http\Request;

class DisabilityTypeController extends Controller
{
    protected $disabilityTypeService;

    public function __construct(DisabilityTypeService $disabilityTypeService)
    {
        $this->disabilityTypeService = $disabilityTypeService;
    }

    public function index(Request $request)
    {
        return $this->disabilityTypeService->getAll($request)->response();

    }

    public function store(DisabilityTypeRequest $request)
    {
        return $this->disabilityTypeService->create($request)->response();
    }

    public function show(ShowRequest $request)
    {
        return $this->disabilityTypeService->getById($request)->response();

    }

    public function update(DisabilityTypeRequest $request)
    {
        return $this->disabilityTypeService->update($request)->response();

    }

    public function destroy(DestroyRequest $request)
    {
       return $this->disabilityTypeService->delete($request)->response();
    }
}
