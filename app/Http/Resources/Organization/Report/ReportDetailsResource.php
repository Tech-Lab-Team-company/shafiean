<?php

namespace App\Http\Resources\Organization\Report;

use App\Http\Resources\Organization\Report\Surah\SurahTitleResource;
use App\Http\Resources\Surah\AyahResource;
use App\Models\Ayah;
use App\Models\Surah\Surah;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportDetailsResource extends ReportResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return array_merge(parent::toArray($request), [
            "from_surah" => $this->fromReportable instanceof Surah ? SurahTitleResource::make($this->fromReportable, $this) : (object)[],
            "to_surah" => $this->toReportable instanceof Surah ? SurahTitleResource::make($this->toReportable, $this) : (object)[],
            'from_ayah' => $this->fromSubReportable instanceof Ayah ? new AyahResource($this->fromSubReportable) : (object)[],
            'to_ayah' => $this->toSubReportable instanceof Ayah  ? new AyahResource($this->toSubReportable) : (object)[],
        ]);
    }
}
