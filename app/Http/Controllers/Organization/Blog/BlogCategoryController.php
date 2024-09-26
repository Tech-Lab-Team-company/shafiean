<?php

namespace App\Http\Controllers\Organization\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization\Blog\BlogCategory;
use App\Services\Organization\Blog\BlogCategoryService;
use App\Http\Requests\Organization\BlogCategory\StoreBlogCategoryRequest;
use App\Http\Requests\Organization\BlogCategory\DeleteBlogCategoryRequest;
use App\Http\Requests\Organization\BlogCategory\UpdateBlogCategoryRequest;
use App\Http\Requests\Organization\BlogCategory\FetchBlogCategoryDetailsRequest;

class BlogCategoryController extends Controller
{
    public function __construct(protected  BlogCategoryService $blogCategoryService) {}

    public function index()
    {
        return $this->blogCategoryService->index()->response();
    }
    public function show(FetchBlogCategoryDetailsRequest $request)
    {
        return $this->blogCategoryService->show($request)->response();
    }
    public function store(StoreBlogCategoryRequest $request)
    {
        return $this->blogCategoryService->store($request->validated())->response();
    }
    public function update(UpdateBlogCategoryRequest $request)
    {
        return $this->blogCategoryService->update($request->validated())->response();
    }
    public function delete(DeleteBlogCategoryRequest $request)
    {
        return $this->blogCategoryService->delete($request)->response();
    }
}
