<?php

namespace App\Services\Organization\Blog;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\BlogHashtag;
use App\Models\Organization\Blog\BlogCategory;
use App\Http\Resources\Organization\BlogHashtag\BlogHashtagResource;
use App\Http\Resources\Organization\BlogCategory\BlogCategoryResource;

class BlogHashtagService
{
    public function index()
    {
        try {
            $blogHashtags = BlogHashtag::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: BlogHashtagResource::collection($blogHashtags)->response()->getData(true),
                status: true,
                message: 'Blog Hashtags fetched successfully'
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
        $blogHashtag = BlogHashtag::whereId($request->id)->first();
        return new DataSuccess(
            data: new BlogHashtagResource($blogHashtag),
            statusCode: 200,
            message: 'Fetch Blog Hashtag successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            if (isset($dataRequest['image'])) {
                $dataRequest['image'] = upload_image(folder: 'blog_hashtag', image: $dataRequest['image']);
            }
            $blogHashtag = BlogHashtag::create($dataRequest);
            return new DataSuccess(
                data: new BlogHashtagResource($blogHashtag),
                status: true,
                message: 'Blog Hashtag created successfully'
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
            $blogHashtag = BlogHashtag::whereId($dataRequest['id'])->first();
            if (isset($dataRequest['image'])) {
                if ($blogHashtag->image) {
                    delete_image(old_image_path: $blogHashtag->image, disk: 'public');
                }
                $dataRequest['image'] = upload_image(folder: 'blog_hashtag', image: $dataRequest['image']);
            }
            unset($dataRequest['id']);
            $blogHashtag->update($dataRequest);
            return new DataSuccess(
                data: new BlogHashtagResource($blogHashtag),
                status: true,
                message: 'Blog Hashtag updated successfully'
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
            BlogHashtag::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Blog Hashtag deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Blog Hashtag deletion failed: ' . $e->getMessage()
            );
        }
    }
}
