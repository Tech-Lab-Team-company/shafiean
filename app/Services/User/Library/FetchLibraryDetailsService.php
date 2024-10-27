<?php

namespace App\Services\User\Library;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;

class FetchLibraryDetailsService
{
    public function show($request)
    {
        $library = Library::whereId($request->id)->first();
        return new DataSuccess(
            data: new LibraryResource($library),
            statusCode: 200,
            message: 'Fetch Library Details successfully'
        );
    }
}
