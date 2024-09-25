<?php

namespace App\Http\Controllers\Organization\Term;


use App\Http\Controllers\Controller;
use App\Http\Requests\Term\TermRequest;
use App\Services\Organization\Term\TermService;

class TermController extends Controller
{
    protected $termService;

    public function __construct(TermService $termService)
    {
        $this->termService = $termService;
    }

    public function index()
    {
        return $this->termService->getAllTerms()->response();
    }

    public function store(TermRequest $request)
    {
        return $this->termService->createTerm($request->validated())->response();
    }

    public function show($id)
    {
        return $this->termService->getTermById($id)->response();
    }

    public function update(TermRequest $request, $id)
    {
        return $this->termService->updateTerm($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->termService->deleteTerm($id)->response();
    }
}
