<?php

namespace App\Services\Organization\Blog;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\BlogCategory\BlogCategoryResource;
use App\Models\Organization\Blog\BlogCategory;
use App\Models\Organization\Library\Library;

class BlogCategoryService
{
    public function index()
    {
        try {
            $blogCategories = BlogCategory::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: BlogCategoryResource::collection($blogCategories)->response()->getData(true),
                status: true,
                message: 'Blog Categories fetched successfully'
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
        $blogCategory = BlogCategory::whereId($request->id)->first();
        return new DataSuccess(
            data: new BlogCategoryResource($blogCategory),
            statusCode: 200,
            message: 'Fetch Blog Category successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $blogCategory = BlogCategory::create($dataRequest);
            return new DataSuccess(
                data: new BlogCategoryResource($blogCategory),
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
            $blogCategory = BlogCategory::whereId($dataRequest['id'])->first();

            unset($dataRequest['id']);
            $blogCategory->update($dataRequest);
            return new DataSuccess(
                data: new BlogCategoryResource($blogCategory),
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
            BlogCategory::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Blog Category deletion failed: ' . $e->getMessage()
            );
        }
    }
}
