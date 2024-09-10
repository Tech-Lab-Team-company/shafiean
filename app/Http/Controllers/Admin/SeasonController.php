<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Season\AddSeasonRequest;
use App\Http\Requests\Season\ChangeSeasonActiveStatusRequest;
use App\Http\Requests\Season\DeleteSeasonRequest;
use App\Http\Requests\Season\EditSeasonRequest;
use App\Http\Requests\Season\FetchSeasonDetailsRequest;
use App\Http\Requests\Season\FetchSeasonsRequest;
use App\Services\SeasonService;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    protected $season_service;

    public function __construct(SeasonService $seasonService)
    {
        $this->season_service = $seasonService;
    }

    public function index(FetchSeasonsRequest $request){

        return $this->season_service->getAll($request)->response();
    }

    public function store(AddSeasonRequest $request){

        return $this->season_service->store($request)->response();
    }

    public function show(FetchSeasonDetailsRequest $request){

        return $this->season_service->getDetails($request)->response();
    }

    public function update(EditSeasonRequest $request){

        return $this->season_service->update($request)->response();
    }

    public function destroy(DeleteSeasonRequest $request){

        return $this->season_service->delete($request)->response();
    }

    public function changeActiveStatus(ChangeSeasonActiveStatusRequest $request){

        return $this->season_service->changeActiveStatus($request)->response();
    }
}
