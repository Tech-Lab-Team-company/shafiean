<?php

namespace App\Services\Organization\EndPoint\LibraryCategory;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;
use App\Models\Organization\LibraryCategory\LibraryCategory;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

class FetchLibraryCategoryService
{
    public function fetchLibraryCategory()
    {
        try {
            $libraryCategories = LibraryCategory::orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: LibraryCategoryResource::collection($libraryCategories),
                status: true,
                message: 'Fetch Library Categories fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
