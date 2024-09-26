<?php

namespace App\Services\Organization\Blog;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Blog\BlogHashtag;
use App\Http\Resources\Organization\Blog\BlogResource;
use App\Http\Resources\Organization\BlogHashtag\BlogHashtagResource;

class BlogService
{
    public function index()
    {
        try {
            $blogs = Blog::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: BlogResource::collection($blogs)->response()->getData(true),
                status: true,
                message: 'Blogs fetched successfully'
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
        $blog = Blog::whereId($request->id)->first();
        return new DataSuccess(
            data: new BlogResource($blog),
            statusCode: 200,
            message: 'Blog successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            if (isset($dataRequest['image'])) {
                $data['image'] = upload_image(folder: 'blog', image: $dataRequest['image']);
            }
            $data['title'] = $dataRequest['title'];
            $data['description'] = $dataRequest['description'];
            $blog = Blog::create($data);
            if (isset($dataRequest['blog_hashtags'])) {
                $blog->blogHashtagRelations()->attach($dataRequest['blog_hashtags']);
            }
            if (isset($dataRequest['blog_categories'])) {
                $blog->blogCategoryRelations()->attach($dataRequest['blog_categories']);
            }
            return new DataSuccess(
                data: new BlogResource($blog),
                status: true,
                message: 'Blog created successfully'
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
            $blog = Blog::whereId($dataRequest['id'])->first();
            if (isset($dataRequest['image'])) {
                if ($blog->image) {
                    delete_image(old_image_path: $blog->image, disk: 'public');
                }
                $dataRequest['image'] = upload_image(folder: 'blog', image: $dataRequest['image']);
            }
            unset($dataRequest['id']);
            $data['title'] = $dataRequest['title'];
            $data['description'] = $dataRequest['description'];
            $blog->update($data);
            if (isset($dataRequest['blog_hashtags'])) {
                $blog->blogHashtagRelations()->sync($dataRequest['blog_hashtags']);
            }
            if (isset($dataRequest['blog_categories'])) {
                $blog->blogCategoryRelations()->sync($dataRequest['blog_categories']);
            }
            return new DataSuccess(
                data: new BlogResource($blog),
                status: true,
                message: 'Blog updated successfully'
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
            Blog::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Blog deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Blog deletion failed: ' . $e->getMessage()
            );
        }
    }
}
