<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityTypeRequest;
use App\Http\Resources\DisabilityTypeResource;
use App\Services\DisabilityTypeService;
use Illuminate\Http\Response;

class DisabilityTypeController extends Controller
{
    protected $disabilityTypeService;

    public function __construct(DisabilityTypeService $disabilityTypeService)
    {
        $this->disabilityTypeService = $disabilityTypeService;
    }

    public function index()
    {
        return $this->disabilityTypeService->getAll()->response();

    }

    public function store(DisabilityTypeRequest $request)
    {
        return $this->disabilityTypeService->create($request->validated())->response();
    }

    public function show($id)
    {
        return $this->disabilityTypeService->getById($id)->response();

    }

    public function update(DisabilityTypeRequest $request, $id)
    {
        return $this->disabilityTypeService->update($id, $request->validated())->response();

    }

    public function destroy($id)
    {
       return $this->disabilityTypeService->delete($id)->response();
    }
}
