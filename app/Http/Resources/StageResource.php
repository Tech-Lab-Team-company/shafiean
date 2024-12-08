<?php

namespace App\Http\Resources;

use App\Http\Resources\CurriculumResource;
use App\Http\Resources\Surah\SurahResource;
use App\Http\Resources\DisabilityTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'curriculum' => new CurriculumResource($this->curriculum),
            'status' => $this->status,
            'disability' => DisabilityTypeResource::collection($this->disabilityTypes),
            'surahs' => SurahResource::collection($this->surahs),
            // 'type' => $this->type,
        ];
    }
}
