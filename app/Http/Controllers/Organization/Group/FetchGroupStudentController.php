<?php

namespace App\Http\Controllers\Organization\Group;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Group\FetchGroupStudentRequest;
use App\Services\Organization\EndPoint\Group\FetchGroupStudentService;

class FetchGroupStudentController extends Controller
{
    public function __construct(protected FetchGroupStudentService $fetchGroupStudentService) {}
    public function fetchGroupStudent(FetchGroupStudentRequest $request)
    {
        return $this->fetchGroupStudentService->fetchGroupStudent($request)->response();
    }
}
