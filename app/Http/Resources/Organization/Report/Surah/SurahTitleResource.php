<?php

namespace App\Http\Resources\Organization\Report\Surah;

use Illuminate\Http\Request;
use App\Http\Resources\Surah\AyahResource;
use App\Models\Ayah;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahTitleResource extends JsonResource
{
    protected $report;
    public function __construct($resource, $report)
    {
        parent::__construct($resource); 
        $this->report = $report;

    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data['id'] = $this->id ?? 0;
        $data['title'] = $this->name ?? '';
        // $data['from_ayah'] = $this->report->fromSubReportable instanceof Ayah ? new AyahResource($this->report->fromSubReportable) : (object)[];
        // $data['to_ayah'] = $this->report->toSubReportable instanceof Ayah  ? new AyahResource($this->report->toSubReportable) : (object)[];
        return $data;
    }
}
