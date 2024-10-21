<?php
namespace App\Http\Controllers\User\Blog;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Blog\FetchUserBlogService;
use App\Services\Organization\EndPoint\BlogHashtag\FetchBlogHashtagService;

class FetchUserBlogController extends Controller
{
    public function __construct(protected FetchUserBlogService $fetchUserBlogService) {}

    public function __invoke()
    {
        return $this->fetchUserBlogService->fetchUserBlog()->response();
    }
}
