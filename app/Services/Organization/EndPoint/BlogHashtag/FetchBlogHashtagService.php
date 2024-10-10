<?php

namespace App\Services\Organization\EndPoint\BlogHashtag;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\BlogHashtag;
use App\Http\Resources\Organization\EndPoint\BlogHashtag\FetchBlogHashtagResource;

class FetchBlogHashtagService
{
    public function fetchBlogHashtags()
    {
        try {
            $blogHashtags  = BlogHashtag::get();
            return new DataSuccess(
                data: FetchBlogHashtagResource::collection($blogHashtags),
                status: true,
                message: 'Fetch BlogHashtag successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
