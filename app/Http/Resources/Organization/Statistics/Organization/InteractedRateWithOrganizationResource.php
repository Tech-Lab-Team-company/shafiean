<?php
namespace App\Http\Resources\Organization\Statistics\Organization;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentGroupResource;
use App\Http\Resources\Admin\Statistics\Student\StatisticLatestStudentDisabilityTypeResource;

class InteractedRateWithOrganizationResource  extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'months' => $this['months'] ?? 0,
            'user_counts' => $this['user_counts'] ?? 0,
        ];
    }
}
