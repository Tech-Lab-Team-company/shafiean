<?php

namespace App\Http\Resources\User\EndPoint\Blog;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\BlogHashtag\BlogHashtagResource;
use App\Http\Resources\Organization\BlogCategory\BlogCategoryResource;

class FetchUserBlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
            'description' => $this->description??"",
            'image' => $this->image_link??"",
            'blog_hashtags' => BlogHashtagResource::collection($this->blogHashtagRelations)??[],
            'blog_categories' => BlogCategoryResource::collection($this->blogCategoryRelations)??[],
        ];
    }
}
