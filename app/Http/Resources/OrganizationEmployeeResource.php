<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Enum\EmployeeTypeEnum;
use App\Http\Resources\ImageResource;
use App\Http\Resources\CurriculumResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\JobType\JobTypeResource;

class OrganizationEmployeeResource extends JsonResource
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
            'email' => $this->email,
            'image' => $this->image_link,
            'age' => $this->age,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'is_master' => $this->is_master,
            'organization_id' => $this->organization_id,
            'marital_status' => $this->marital_status,
            'identity_type' => $this->identity_type,
            'identity_number' => $this->identity_number,
            'date_of_birth' => $this->date_of_birth,
            'is_employed' => $this->is_employed,
            'status' => EmployeeTypeEnum::from($this->is_employed)->label(),
            'curriculums' =>  CurriculumResource::collection($this->curriculums ?? []) ?? [],
            'images' => $this->images()->count() > 0 ? ImageResource::collection($this->images) : [],
            'job_type' => new JobTypeResource($this->jobType)
        ];
    }
}
