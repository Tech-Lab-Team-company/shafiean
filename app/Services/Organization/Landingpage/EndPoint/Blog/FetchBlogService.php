<?php

namespace App\Services\Organization\Landingpage\EndPoint\Blog;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Competition\Competition;
use App\Http\Resources\Organization\Landingpage\EndPoint\Blog\FetchBlogResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Competition\FetchCompetitionResource;

class FetchBlogService
{
    public function fetchBlogs()
    {
        try {
            $blogs  = Blog::get();
            return new DataSuccess(
                data: FetchBlogResource::collection($blogs),
                status: true,
                message: 'Fetch Blogs successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
