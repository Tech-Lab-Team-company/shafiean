<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\AddGroupRequest;
use App\Http\Requests\Group\ChangeGroupActiveStatusRequest;
use App\Http\Requests\Group\DeleteGroupRequest;
use App\Http\Requests\Group\EditGroupRequest;
use App\Http\Requests\Group\FetchGroupDetailsRequest;
use App\Http\Requests\Group\FetchGroupsRequest;
use App\Services\Organization\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $group_service;

    public function __construct(GroupService $group_service)
    {
        $this->group_service = $group_service;
    }

    public function fetch_groups(FetchGroupsRequest $request)
    {
        return $this->group_service->fetch_groups($request)->response();
    }

    public function add_group(AddGroupRequest $request)
    {
        return $this->group_service->add_group($request)->response();
    }

    public function fetch_group_details(FetchGroupDetailsRequest $request){

        return $this->group_service->fetch_group_details($request)->response();
    }
    public function edit_group(EditGroupRequest $request){

        return $this->group_service->edit_group($request)->response();
    }
    public function delete_group(DeleteGroupRequest $request){
        return $this->group_service->delete_group($request)->response();
    }

    public function change_group_active_status(ChangeGroupActiveStatusRequest $request){

        return $this->group_service->change_group_active_status($request)->response();
    }
}
