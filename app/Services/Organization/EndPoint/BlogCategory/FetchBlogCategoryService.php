<?php

namespace App\Services\Organization\EndPoint\BlogCategory;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\BlogCategory;
use App\Http\Resources\Organization\EndPoint\BlogHashtag\FetchBlogHashtagResource;
use App\Http\Resources\Organization\EndPoint\BlogCategory\FetchBlogCategoryResource;

class FetchBlogCategoryService
{
    public function fetchBlogCategories()
    {
        try {
            $blogCategories  = BlogCategory::get();
            return new DataSuccess(
                data: FetchBlogCategoryResource::collection($blogCategories),
                status: true,
                message: 'Fetch BlogCategory successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
