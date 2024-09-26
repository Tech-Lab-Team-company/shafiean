<?php

namespace App\Http\Controllers\Organization\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Blog\BlogHashtagService;
use App\Http\Requests\Organization\BlogHashtage\StoreBlogHashtagRequest;
use App\Http\Requests\Organization\BlogHashtage\DeleteBlogHashtagRequest;
use App\Http\Requests\Organization\BlogHashtage\UpdateBlogHashtagRequest;
use App\Http\Requests\Organization\BlogHashtage\FetchBlogHashtagDetailsRequest;

class BlogHashtagController extends Controller
{
    public function __construct(protected  BlogHashtagService $blogHashTagService) {}

    public function index()
    {
        return $this->blogHashTagService->index()->response();
    }
    public function show(FetchBlogHashtagDetailsRequest $request)
    {
        return $this->blogHashTagService->show($request)->response();
    }
    public function store(StoreBlogHashtagRequest $request)
    {
        return $this->blogHashTagService->store($request->validated())->response();
    }
    public function update(UpdateBlogHashtagRequest $request)
    {
        return $this->blogHashTagService->update($request->validated())->response();
    }
    public function delete(DeleteBlogHashtagRequest $request)
    {
        return $this->blogHashTagService->delete($request)->response();
    }
}
