<?php

namespace App\Services\Organization\Landingpage\EndPoint\Privacy;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Landingpage\Privacy;
use App\Models\Organization\Competition\Competition;
use App\Http\Resources\Organization\Landingpage\EndPoint\Blog\FetchBlogResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Privacy\FetchPrivacyResource;
use App\Http\Resources\Organization\Landingpage\EndPoint\Competition\FetchCompetitionResource;

class FetchPrivacyService
{
    public function fetchPrivacy()
    {
        try {
            $privacy  = Privacy::first();
            return new DataSuccess(
                data: new FetchPrivacyResource($privacy),
                status: true,
                message: 'Fetch Privacy successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
