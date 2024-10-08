<?php

namespace App\Http\Resources\Organization\Curriculum;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchCurriculumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
