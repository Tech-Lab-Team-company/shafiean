<?php
namespace App\Http\Controllers\User\Blog;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Blog\FetchBlogDetailRequest;
use App\Services\User\Blog\FetchUserBlogService;
use App\Services\Organization\EndPoint\BlogHashtag\FetchBlogHashtagService;

class FetchUserBlogController extends Controller
{
    public function __construct(protected FetchUserBlogService $fetchUserBlogService) {}

    public function fetchBlogs()
    {
        return $this->fetchUserBlogService->fetchUserBlog()->response();
    }

    public function fetchBlogDetails(FetchBlogDetailRequest $request)
    {
        return $this->fetchUserBlogService->fetchBlogDetails($request)->response();
    }
}
