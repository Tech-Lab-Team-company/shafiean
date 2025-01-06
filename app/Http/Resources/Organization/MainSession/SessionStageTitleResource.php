<?php

namespace App\Http\Resources\Organization\MainSession;


use App\Http\Resources\CurriculumResource;
use App\Http\Resources\StageTitleResource;
use App\Http\Resources\Surah\SurahResource;
use App\Http\Resources\DisabilityTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionStageTitleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->stage->id ?? 0,
            'title' => $this->stage->title ?? "",
        ];
    }
}
