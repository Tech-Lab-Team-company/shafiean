<?php

namespace App\Http\Controllers\Organization\Employee;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\AddEmployeeRequest;
use App\Http\Requests\Employee\EditEmployeeRequest;
use App\Http\Requests\Employee\DeleteEmployeeRequest;
use App\Http\Requests\Employee\FetchEmployeesRequest;
use App\Services\Organization\Employee\EmployeeService;
use App\Http\Requests\Employee\EditEmployeePasswordRequest;
use App\Http\Requests\Employee\FetchEmployeeDetailsRequest;
use App\Http\Requests\Employee\FetchTeachersRequest;

class EmployeeController extends Controller
{

    protected $employee_service;

    public function __construct(EmployeeService $employee_service)
    {
        $this->employee_service = $employee_service;
    }

    public function fetch_employees(FetchEmployeesRequest $request)
    {

        return $this->employee_service->fetch_employees($request)->response();
    }
    public function add_employee(AddEmployeeRequest $request)
    {

        return $this->employee_service->createEmployee($request)->response();
    }

    public function update_employee(EditEmployeeRequest $request)
    {

        return $this->employee_service->update_employee($request)->response();
    }

    public function fetch_employee_details(FetchEmployeeDetailsRequest $request)
    {

        return $this->employee_service->fetch_employee_details($request)->response();
    }

    public function delete_employee(DeleteEmployeeRequest $request)
    {

        return $this->employee_service->delete_employee($request)->response();
    }

    public function edit_employee_password(EditEmployeePasswordRequest $request)
    {

        return $this->employee_service->edit_employee_password($request)->response();
    }

    public function fetch_teachers(FetchTeachersRequest $request)
    {
        return $this->employee_service->fetch_teachers($request)->response();
    }
}
