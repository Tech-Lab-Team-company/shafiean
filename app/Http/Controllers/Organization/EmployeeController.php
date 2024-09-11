<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\AddEmployeeRequest;
use App\Services\Organization\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $employee_service;

    public function __construct(EmployeeService $employee_service)
    {
        $this->employee_service = $employee_service;
    }

    public function add_employee(AddEmployeeRequest $request) {

        return $this->employee_service->createEmployee($request)->response();
    }
}
