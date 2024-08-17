<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityTypeRequest;
use App\Http\Resources\DisabilityTypeResource;
use App\Models\DisabilityType;
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
        return DisabilityTypeResource::collection($this->disabilityTypeService->getAll());
    }

    public function store(DisabilityTypeRequest $request)
    {
        $disabilityType = $this->disabilityTypeService->create($request->validated());
        return new DisabilityTypeResource($disabilityType);
    }

    public function show($id)
    {
        $disabilityType = $this->disabilityTypeService->getById($id);
        return new DisabilityTypeResource($disabilityType);
    }

    public function update(DisabilityTypeRequest $request, DisabilityType $disabilityType)
    {
        $updatedDisabilityType = $this->disabilityTypeService->update($disabilityType, $request->validated());
        return new DisabilityTypeResource($updatedDisabilityType);
    }

    public function destroy(DisabilityType $disabilityType)
    {
        $this->disabilityTypeService->delete($disabilityType);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

