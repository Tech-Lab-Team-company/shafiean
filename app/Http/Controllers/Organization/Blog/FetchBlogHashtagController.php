<?php

namespace App\Http\Controllers\Organization\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\BlogHashtag\FetchBlogHashtagService;

class FetchBlogHashtagController extends Controller
{
    public function __construct(protected FetchBlogHashtagService $fetchBloodTypeService) {}

    public function __invoke()
    {
        return $this->fetchBloodTypeService->fetchBlogHashtags()->response();
    }
}
