<?php

namespace App\Http\Resources\User\Report;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceAndDepartureReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id ?? 0,
            'title' => $this->session->title ?? "",
            'teacher_name' => $this->group->teacher->name ?? "",
        ];
    }
}
