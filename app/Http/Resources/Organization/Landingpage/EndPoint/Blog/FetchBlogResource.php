<?php

namespace App\Http\Resources\Organization\Landingpage\EndPoint\Blog;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\BlogHashtag\BlogHashtagResource;
use App\Http\Resources\Organization\BlogCategory\BlogCategoryResource;
use Carbon\Carbon;

class FetchBlogResource extends JsonResource
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
            'description' => $this->description ?? "",
            'image' => $this->image_link ?? "",
            "created_at" => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
