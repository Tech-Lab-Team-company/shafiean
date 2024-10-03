<?php

namespace App\Http\Controllers\User\Group;

use App\Http\Controllers\Controller;
use App\Services\User\Group\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $groupService;


    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function fetch_groups(Request $request){

        return $this->groupService->fetch_groups($request)->response();
    }
}
