<?php

namespace App\Services\Organization\LibraryCategory;



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

class LibraryCategoryService
{
    public function index()
    {
        try {
            $libraryCategories = LibraryCategory::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: LibraryCategoryResource::collection($libraryCategories)->response()->getData(true),
                status: true,
                message: 'Library Categories fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($request)
    {
        $libraryCategory = LibraryCategory::whereId($request->id)->first();
        return new DataSuccess(
            data: new LibraryCategoryResource($libraryCategory),
            statusCode: 200,
            message: 'Fetch Library Category successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $libraryCategory = LibraryCategory::create($dataRequest);
            return new DataSuccess(
                data: new LibraryCategoryResource($libraryCategory),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $libraryCategory = LibraryCategory::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $libraryCategory->update($dataRequest);
            return new DataSuccess(
                data: new LibraryCategoryResource($libraryCategory),
                status: true,
                message: __('messages.success_update')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            LibraryCategory::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Library Category deletion failed: ' . $e->getMessage()
            );
        }
    }
}
