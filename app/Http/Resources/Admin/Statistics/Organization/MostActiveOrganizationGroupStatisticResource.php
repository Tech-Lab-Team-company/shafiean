<?php

namespace App\Http\Resources\Admin\Statistics\Organization;



use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentGroupResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentDisabilityTypeResource;

class MostActiveOrganizationGroupStatisticResource  extends JsonResource
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
            'title' => $this->title ?? "",
            'user_count' => $this->subscriptions_count ?? 0,
        ];
    }
}
