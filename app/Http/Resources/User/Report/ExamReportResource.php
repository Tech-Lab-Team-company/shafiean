<?php

namespace App\Http\Resources\User\Report;

use Carbon\Carbon;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamReportResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $examResult = $this->exam_results->where('user_id', Auth::guard('user')->user()->id)->first();
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'start_date' => filled($this->start_date) ? $this->start_date : "",
            'is_done' => $examResult ? 1 : 0
        ];
    }
}
