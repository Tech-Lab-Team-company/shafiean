<?php
namespace App\Http\Resources\Organization\Subscription;


use Illuminate\Http\Request;
use App\Http\Resources\YearResource;
use App\Http\Resources\StageResource;
use App\Http\Resources\SeasonResource;
use App\Http\Resources\CurriculumResource;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\DisabilityTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'status' => $this->status,
            // 'all_curriculum' => $this->all_curriculum,
            // 'year' => new YearResource($this->year),
            // 'season' => new SeasonResource($this->season),
            // 'curriculum' => new CurriculumResource($this->curriculum),
            // 'disability_types' =>  DisabilityTypeResource::collection($this->disability_types),
            // 'stages' => StageResource::collection($this->stages),
            // 'organization' => new OrganizationResource($this->organization),
        ];
    }
}
