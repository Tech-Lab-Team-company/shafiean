<?php

namespace App\Services\Organization\Library;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use Illuminate\Support\Facades\File;
use App\Helpers\Response\DataSuccess;
use Illuminate\Support\Facades\Storage;
use App\Models\Organization\Library\Library;
use App\Http\Resources\Organization\Library\LibraryResource;

class LibraryService
{
    public function index()
    {
        try {
            $libraries = Library::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: LibraryResource::collection($libraries)->response()->getData(true),
                status: true,
                message: 'Libraries fetched successfully'
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
        $library = Library::whereId($request->id)->first();
        return new DataSuccess(
            data: new LibraryResource($library),
            statusCode: 200,
            message: 'Fetch Library successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            if (isset($dataRequest['file'])) {
                $dataRequest['file'] = uploadFile(folder: 'libraries', file: $dataRequest['file']);
            }
            $library = Library::create($dataRequest);
            return new DataSuccess(
                data: new LibraryResource($library),
                status: true,
                message: 'Library created successfully'
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
            $library = Library::whereId($dataRequest['id'])->first();
            if (isset($dataRequest['file'])) {
                if ($library->file) {
                    deleteFile(filePath: $library->file, disk: 'public');
                }
                $dataRequest['file'] = uploadFile(folder: 'libraries', file: $dataRequest['file']);
            }
            unset($dataRequest['id']);
            $library->update($dataRequest);
            return new DataSuccess(
                data: new LibraryResource($library),
                status: true,
                message: 'Library updated successfully'
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
            Library::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Library deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Library deletion failed: ' . $e->getMessage()
            );
        }
    }
}
