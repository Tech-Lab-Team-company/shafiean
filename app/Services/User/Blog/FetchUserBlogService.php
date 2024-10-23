<?php

namespace App\Services\User\Blog;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Blog\BlogHashtag;
use App\Http\Resources\User\EndPoint\Blog\FetchUserBlogResource;
use App\Http\Resources\Organization\EndPoint\BlogHashtag\FetchBlogHashtagResource;

class FetchUserBlogService
{
    public function fetchUserBlog()
    {
        try {
            $blogs  = Blog::get();
            return new DataSuccess(
                data: FetchUserBlogResource::collection($blogs),
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

    public function fetchBlogDetails($request) :DataStatus
    {
        try {
            $blog = Blog::find($request->blog_id);
            return new DataSuccess(
                data: new FetchUserBlogResource($blog),
                status: true,
                message: 'Fetch Blog successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
