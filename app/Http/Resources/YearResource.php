<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class YearResource extends JsonResource
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
            'status' => $this->status,
            'country' => new CountryResource($this->country),
            'start_date' => $this->start_date ?? '',
            'hijri_start_date' => $this->hijri_start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'hijri_end_date' => $this->hijri_end_date ?? ''
        ];
    }
}
