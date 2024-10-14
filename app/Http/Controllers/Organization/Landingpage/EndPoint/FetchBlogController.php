<?php

namespace App\Http\Controllers\Organization\Landingpage\EndPoint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\EndPoint\Blog\FetchBlogService;

class FetchBlogController  extends Controller
{

    public function __construct(protected FetchBlogService $fetchBlogService) {}

    public function __invoke()
    {
        return $this->fetchBlogService->fetchBlogs()->response();
    }
}
