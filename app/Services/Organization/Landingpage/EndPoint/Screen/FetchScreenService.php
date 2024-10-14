<?php

namespace App\Services\Organization\Landingpage\EndPoint\Screen;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Landingpage\Screen;
use App\Http\Resources\Organization\Landingpage\EndPoint\Screen\FetchScreenResource;

class FetchScreenService
{
    public function fetchScreens()
    {
        try {
            $screens  = Screen::get();
            return new DataSuccess(
                data:  FetchScreenResource::collection($screens),
                status: true,
                message: 'Fetch Screens successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
