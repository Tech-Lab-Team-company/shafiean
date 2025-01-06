<?php

namespace App\Http\Resources;

use App\Http\Resources\CurriculumResource;
use App\Http\Resources\Surah\SurahResource;
use App\Http\Resources\DisabilityTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StageTitleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id??0,
            'title' => $this->title??"",
        ];
    }
}
