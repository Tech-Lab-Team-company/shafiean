<?php

namespace App\Services\Organization\EndPoint\Library;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\User\EndPoint\Library\FetchLibraryResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

class FetchLibraryService
{
    public function fetchLibraryByCategoryId($dataRequest)
    {
        try {
            $libraries = Library::where('library_category_id', $dataRequest->library_category_id)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: FetchLibraryResource::collection($libraries),
                status: true,
                message: 'Fetch Libraries  fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
