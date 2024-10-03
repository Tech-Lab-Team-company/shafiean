<?php

namespace App\Http\Controllers\User\Stage;

use App\Http\Controllers\Controller;
use App\Services\User\Stage\StageService;
use Illuminate\Http\Request;

class StageController extends Controller
{
    protected $stageService;

    public function __construct(StageService $stageService)
    {
        $this->stageService = $stageService;
    }

    public function fetch_stages(Request $request)
    {
        return $this->stageService->fetch_stages($request)->response();
    }
}
