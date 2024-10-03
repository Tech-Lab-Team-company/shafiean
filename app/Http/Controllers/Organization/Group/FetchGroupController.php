<?php

namespace App\Http\Controllers\Organization\Group;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\Group\FetchGroupService;
use App\Services\Organization\EndPoint\JobType\FetchJobTypeService;

class FetchGroupController extends Controller
{
    public function __construct(protected FetchGroupService $fetchGroupService) {}
    public function __invoke()
    {
        return $this->fetchGroupService->fetchGroups()->response();
    }
}
