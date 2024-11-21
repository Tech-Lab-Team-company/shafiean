<?php

namespace App\Http\Resources\User\Report;

use Carbon\Carbon;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class AcademyReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'exam_name' => $this->exam->name ?? "",
            'last_rating_date' => Carbon::parse($this->updated_at)->locale('ar')->translatedFormat('F j ,Y - g:i A') ?? "",
            'degree' => (float)$this->grade ?? 0,
            'total_degree' => (float)$this->exam->degree ?? 0,
        ];
    }
}
