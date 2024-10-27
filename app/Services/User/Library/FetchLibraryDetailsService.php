<?php

namespace App\Services\User\Library;

use Exception;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Library\Library;
use App\Http\Resources\User\Library\FetchLibraryDetailsResource;

class FetchLibraryDetailsService
{
    public function show($request)
    {
        $library = Library::whereId($request->id)->first();
        return new DataSuccess(
            data: new FetchLibraryDetailsResource($library),
            statusCode: 200,
            message: 'Fetch Library Details successfully'
        );
    }
}
