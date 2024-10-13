<?php

namespace App\Http\Controllers\Organization\Landingpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\Screen\ScreenService;
use App\Http\Requests\Organization\Landingpage\Screen\StoreScreenRequest;
use App\Http\Requests\Organization\Landingpage\Screen\DeleteScreenRequest;
use App\Http\Requests\Organization\Landingpage\Screen\UpdateScreenRequest;
use App\Http\Requests\Organization\Landingpage\Screen\FetchScreenDetailsRequest;

class ScreenController extends Controller
{
    public function __construct(protected  ScreenService $screenService) {}
    public function index()
    {
        return $this->screenService->index()->response();
    }
    public function show(FetchScreenDetailsRequest $request)
    {
        return $this->screenService->show($request)->response();
    }
    public function store(StoreScreenRequest $request)
    {
        return $this->screenService->store($request)->response();
    }
    public function update(UpdateScreenRequest $request)
    {
        return $this->screenService->update($request)->response();
    }
    public function delete(DeleteScreenRequest $request)
    {
        return $this->screenService->delete($request)->response();
    }
}
