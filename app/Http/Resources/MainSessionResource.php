<?php

namespace App\Http\Resources;

use App\Http\Resources\Surah\AyahTitleResource;
use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use App\Http\Resources\Live\LiveInfoResource;
use App\Http\Resources\Surah\SurahTitleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MainSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $isLive = $this->lives()->count() > 0 ? true : false;
        return [
            'id' => $this->id ?? 0,
            'title' => $this->title ?? "",
            'status' => $this->status ?? "",
            'start_verse' => $this->start_verse ?? "",
            'end_verse' => $this->end_verse ?? "",
            "quraan" => new QuraanResource($this->quraan) ?? "",
            "stage" => new StageResource($this->stage) ?? "",
            'surah' => new SurahTitleResource($this->surah) ?? "",
            'start_ayah' => new AyahTitleResource($this->startAyah) ?? "",
            'end_ayah' => new AyahTitleResource($this->endAyah) ?? "",
            // 'is_live' => $isLive ?? "",
            // 'live' => $isLive ?  LiveInfoResource::collection($this->lives) : []
        ];
    }
}
