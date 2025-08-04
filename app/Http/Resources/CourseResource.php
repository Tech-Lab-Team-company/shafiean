<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'all_curriculum' => $this->all_curriculum,
            'start_date' => $this->start_date ?? '',
            'hijri_start_date' => $this->start_date ? Carbon::parse($this->start_date)->toHijri()->isoFormat('LLLL') : "",
            'end_date' => $this->end_date ?? '',
            'hijri_end_date' => $this->end_date ? Carbon::parse($this->end_date)->toHijri()->isoFormat('LLLL') : "",
            'year' => new YearResource($this->year),
            'season' => new SeasonResource($this->season),
            'curriculum' => new CurriculumResource($this->curriculum),
            'disability_types' =>  DisabilityTypeResource::collection($this->disability_types),
            'stages' => StageResource::collection($this->stages),
            // 'organization' => new OrganizationResource($this->organization),
        ];
    }
}
