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

    public function update(DisabilityTypeRequest $request, $id)
    {
        $updatedDisabilityType = $this->disabilityTypeService->update($id, $request->validated());
        return new DisabilityTypeResource($updatedDisabilityType);
    }

    public function destroy($id )
    {
        $this->disabilityTypeService->delete($id);
        return response()->json(['message' => 'disability deleted successfully.'], 200);
    }
}

