<?php
namespace App\Services\Organization\Landingpage\EndPoint\Header;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\BlogCategory;
use App\Models\Organization\Landingpage\Header;
use App\Http\Resources\Organization\EndPoint\BlogHashtag\FetchBlogHashtagResource;
use App\Http\Resources\Organization\EndPoint\BlogCategory\FetchBlogCategoryResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Header\FetchHeaderResource;

class FetchHeaderService
{
    public function fetchheaders()
    {
        try {
            $headers  = Header::get();
            return new DataSuccess(
                data: FetchHeaderResource::collection($headers),
                status: true,
                message: 'Fetch Headers successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
