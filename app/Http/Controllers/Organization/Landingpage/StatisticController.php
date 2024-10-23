<?php

namespace App\Http\Controllers\Organization\Landingpage;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Statistic\StatisticService;
use App\Http\Requests\Organization\Landingpage\Statistic\StoreStatisticRequest;
use App\Http\Requests\Organization\Landingpage\Statistic\DeleteStatisticRequest;
use App\Http\Requests\Organization\Landingpage\Statistic\UpdateStatisticRequest;
use App\Http\Requests\Organization\Landingpage\Statistic\FetchStatisticDetailsRequest;

class StatisticController extends Controller
{
    public function __construct(protected  StatisticService $statisticService) {}
    public function index(Request $request)
    {
        return $this->statisticService->index($request)->response();
    }
    public function show(FetchStatisticDetailsRequest $request)
    {
        return $this->statisticService->show($request)->response();
    }
    public function store(StoreStatisticRequest $request)
    {
        return $this->statisticService->store($request)->response();
    }
    public function update(UpdateStatisticRequest $request)
    {
        return $this->statisticService->update($request)->response();
    }
    public function delete(DeleteStatisticRequest $request)
    {
        return $this->statisticService->delete($request)->response();
    }
}
