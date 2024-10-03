<?php

namespace App\Http\Controllers\Organization\BloodType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\BloodType\FetchBloodTypeService;

class FetchBloodTypeController extends Controller
{
    public function __construct(protected FetchBloodTypeService $fetchBloodTypeService) {}

    public function __invoke()
    {
        return $this->fetchBloodTypeService->fetchBloodTypes()->response();
    }
}
