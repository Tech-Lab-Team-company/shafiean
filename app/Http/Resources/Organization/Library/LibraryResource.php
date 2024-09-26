<?php

namespace App\Http\Resources\Organization\Library;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id ?? 0,
            'name'=> $this->name ?? '',
            'description'=> $this->description ?? '',
            'file'=> $this->file_link ?? '',
        ];
    }
}
