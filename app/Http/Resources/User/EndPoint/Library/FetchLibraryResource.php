<?php

namespace App\Http\Resources\User\EndPoint\Library;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\BlogCategory\BlogCategoryResource;
use App\Http\Resources\Organization\LibraryCategory\LibraryCategoryResource;

class FetchLibraryResource extends JsonResource
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
            'name' => $this->name ?? '',
            'description' => $this->description ?? '',
            'file' => $this->file_link ?? '',

        ];
    }
}
