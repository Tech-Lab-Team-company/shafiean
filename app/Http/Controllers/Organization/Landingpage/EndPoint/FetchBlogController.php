<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Blog\FetchBlogDetailsRequest;
use App\Services\Organization\Landingpage\EndPoint\Blog\FetchBlogService;

class FetchBlogController  extends Controller
{

    public function __construct(protected FetchBlogService $fetchBlogService) {}

    public function landing_page_fetch_blogs()
    {
        return $this->fetchBlogService->fetchBlogs()->response();
    }

    public function landing_page_fetch_blog_details(FetchBlogDetailsRequest $request)
    {
        return $this->fetchBlogService->landing_page_fetch_blog_details($request)->response();
    }
}
