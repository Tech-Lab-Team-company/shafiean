<?php

namespace App\Http\Controllers\Organization\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\Student\FetchStudentService;

class FetchStudentController extends Controller
{
    public function __construct(protected FetchStudentService $fetchStudentService) {}
    public function __invoke()
    {
        return $this->fetchStudentService->fetchUsers()->response();
    }
}
