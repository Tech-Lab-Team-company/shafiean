<?php

namespace App\Http\Controllers\Organization\LibraryCategory;


use App\Http\Controllers\Controller;
use App\Services\Organization\LibraryCategory\LibraryCategoryService;
use App\Http\Requests\Organization\LibraryCategory\StoreLibraryCategoryRequest;
use App\Http\Requests\Organization\LibraryCategory\DeleteLibraryCategoryRequest;
use App\Http\Requests\Organization\LibraryCategory\UpdateLibraryCategoryRequest;
use App\Http\Requests\Organization\LibraryCategory\FetchLibraryCategoryDetailsRequest;

class LibraryCategoryController extends Controller
{
    public function __construct(protected  LibraryCategoryService $libraryCategoryService) {}

    public function index()
    {
        return $this->libraryCategoryService->index()->response();
    }
    public function show(FetchLibraryCategoryDetailsRequest $request)
    {
        return $this->libraryCategoryService->show($request)->response();
    }
    public function store(StoreLibraryCategoryRequest $request)
    {
        return $this->libraryCategoryService->store($request->validated())->response();
    }
    public function update(UpdateLibraryCategoryRequest $request)
    {
        return $this->libraryCategoryService->update($request->validated())->response();
    }
    public function delete(DeleteLibraryCategoryRequest $request)
    {
        return $this->libraryCategoryService->delete($request)->response();
    }
}
