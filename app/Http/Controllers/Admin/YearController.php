<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Year\AddYearRequest;
use App\Http\Requests\Year\ChangeYearActiveStatusRequest;
use App\Http\Requests\Year\DeleteYearRequest;
use App\Http\Requests\Year\EditYearRequest;
use App\Http\Requests\Year\FetchYearDetailsRequest;
use App\Http\Requests\Year\FetchYearsRequest;
use App\Services\YearService;
use Illuminate\Http\Request;

class YearController extends Controller
{
    protected $year_service;

    public function __construct(YearService $yearService)
    {
        $this->year_service = $yearService;
    }

    public function index(FetchYearsRequest $request)
    {

        return $this->year_service->getAll($request)->response();
    }

    public function store(AddYearRequest $request)
    {
        return $this->year_service->store($request)->response();
    }

    public function show(FetchYearDetailsRequest $request)
    {

        return $this->year_service->getDetails($request)->response();
    }
    public function update(EditYearRequest $request)
    {

        return $this->year_service->update($request)->response();
    }

    public function destroy(DeleteYearRequest $request)
    {

        return $this->year_service->destroy($request)->response();
    }
    public function changeActiveStatus(ChangeYearActiveStatusRequest $request)
    {

        return $this->year_service->changeActiveStatus($request)->response();
    }
}
