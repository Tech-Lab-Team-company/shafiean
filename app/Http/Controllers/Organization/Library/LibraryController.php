<?php

namespace App\Http\Controllers\Organization\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Library\LibraryService;
use App\Http\Requests\Organization\Library\StoreLibraryRequest;
use App\Http\Requests\Organization\Library\DeleteLibraryRequest;
use App\Http\Requests\Organization\Library\UpdateLibraryRequest;
use App\Http\Requests\Organization\Library\FetchLibraryDetailsRequest;

class LibraryController extends Controller
{
    public function __construct(protected  LibraryService $libraryService) {}

    public function index()
    {
        return $this->libraryService->index()->response();
    }
    public function show(FetchLibraryDetailsRequest $request)
    {
        return $this->libraryService->show($request)->response();
    }
    public function store(StoreLibraryRequest $request)
    {
        return $this->libraryService->store($request->validated())->response();
    }
    public function update(UpdateLibraryRequest $request)
    {
        return $this->libraryService->update($request->validated())->response();
    }
    public function delete(DeleteLibraryRequest $request)
    {
        return $this->libraryService->delete($request)->response();
    }
}
