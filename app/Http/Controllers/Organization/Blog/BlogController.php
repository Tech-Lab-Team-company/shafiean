<?php

namespace App\Http\Controllers\Organization\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Organization\Blog\BlogService;
use App\Http\Requests\Organization\Blog\StoreBlogRequest;
use App\Http\Requests\Organization\Blog\DeleteBlogRequest;
use App\Http\Requests\Organization\Blog\UpdateBlogRequest;
use App\Http\Requests\Organization\Blog\FetchBlogDetailsRequest;

class BlogController extends Controller
{
    public function __construct(protected  BlogService $blogService) {}

    public function index()
    {
        return $this->blogService->index()->response();
    }
    public function show(FetchBlogDetailsRequest $request)
    {
        return $this->blogService->show($request)->response();
    }
    public function store(StoreBlogRequest $request)
    {
        return $this->blogService->store($request->validated())->response();
    }
    public function update(UpdateBlogRequest $request)
    {
        return $this->blogService->update($request->validated())->response();
    }
    public function delete(DeleteBlogRequest $request)
    {
        return $this->blogService->delete($request)->response();
    }
}
