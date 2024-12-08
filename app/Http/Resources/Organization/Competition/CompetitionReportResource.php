<?php

namespace App\Http\Resources\Organization\Competition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\CompetitionReward\CompetitionRewardResource;

class CompetitionReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'start_date' => $this->start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'image' => $this->image_link ?? '',
            'duration' => calculateDurationInWeeks($this->start_date, $this->end_date),
        ];
    }
}
