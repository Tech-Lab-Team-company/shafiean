<?php
namespace App\Http\Resources\Organization\Statistics\Student;



use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Statistics\Student\StatisticLatestStudentGroupResource;
use App\Http\Resources\Organization\Statistics\Student\StatisticLatestStudentDisabilityTypeResource;

class LatestStudentStatisticResource extends JsonResource
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
            'name' => $this->name ?? "",
            'phone' => $this->phone ?? "",
            'image' => $this->image_link ?? "",
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('Y,d,F')  ?? "",
            'disability_type' => new StatisticLatestStudentDisabilityTypeResource($this->disability_type) ?? "",
            "group" =>  new StatisticLatestStudentGroupResource($this?->groups()?->first()) ?? "",
        ];
    }
}
