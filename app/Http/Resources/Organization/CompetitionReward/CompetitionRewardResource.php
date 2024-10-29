<?php

namespace App\Http\Resources\Organization\CompetitionReward;

use App\Http\Resources\Organization\Competition\CompetitionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionRewardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'stage' => (int) $this->stage ?? "",
            'reward' => (int) $this->reward ?? "",
            // 'competition' => new CompetitionResource($this->competition ?? "") ?? "",
        ];
    }
}
