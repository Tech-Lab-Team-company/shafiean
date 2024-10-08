<?php

namespace App\Http\Controllers\Organization\Season;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\Seanson\FetchSeasonService;

class FetchSeasonController extends Controller
{
    public function __construct(protected FetchSeasonService $fetchSeasonService) {}
    public function __invoke()
    {
        return $this->fetchSeasonService->fetchSeasons()->response();
    }
}
