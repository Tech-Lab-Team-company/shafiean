<?php

namespace App\Http\Controllers\Organization\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\BlogCategory\FetchBlogCategoryService;

class FetchBlogCategoryController  extends Controller
{
    public function __construct(protected FetchBlogCategoryService $fetchBlogCategoryService) {}

    public function __invoke()
    {
        return $this->fetchBlogCategoryService->fetchBlogCategories()->response();
    }
}
