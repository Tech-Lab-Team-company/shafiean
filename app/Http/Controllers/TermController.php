<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Services\TermService;
use App\Http\Requests\TermRequest;
use App\Http\Resources\TermResource;
use Illuminate\Http\Request;

class TermController extends Controller
{
    protected $termService;

    public function __construct(TermService $termService)
    {
        $this->termService = $termService;
    }

    public function index()
    {
        $terms = $this->termService->getAllTerms();
        return TermResource::collection($terms);
    }

    public function store(TermRequest $request)
    {
        $term = $this->termService->createTerm($request->validated());
        return new TermResource($term);
    }

    public function show($id)
    {
        $term = $this->termService->getTermById($id);
        return new TermResource($term);
    }

    public function update(TermRequest $request, $id)
    {
        $term = $this->termService->updateTerm($id, $request->validated());
        return new TermResource($term);
    }

    public function destroy($id)
    {
        $this->termService->deleteTerm($id);
        return response()->json(['message' => 'Term deleted successfully.'], 200);
    }
}

