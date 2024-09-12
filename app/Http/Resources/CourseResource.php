<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'year' => new YearResource($this->year),
            'curriculum' => new CurriculumResource($this->curriculum),
            'disability_types' =>  DisabilityTypeResource::collection($this->disability_types),
            // 'organization' => new OrganizationResource($this->organization),
        ];
    }
}
