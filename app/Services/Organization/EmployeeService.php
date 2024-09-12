<?php

namespace App\Services\Organization;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\OrganizationEmployeeResource;
use App\Models\Teacher;
use Exception;

class EmployeeService
{

    public function fetch_employees($request): DataStatus
    {
        try {
            $employees = Teacher::where('organization_id', get_organization_id(auth()->guard('organization')->user()))->paginate(10);
            return new DataSuccess(
                data: OrganizationEmployeeResource::collection($employees)->response()->getData(true),
                status: true,
                message: 'Employees fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function createEmployee($request): DataStatus
    {
        try {
            // dd(auth()->guard('organization')->user());
            if ($request->hasFile('image')) {
                $image = upload_image($request->file('image'), 'employees');
                $data['image'] = $image;
            }
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['password'] = $request->password;
            $data['gender'] = $request->gender;
            $data['age'] = $request->age;
            $data['is_employed'] = $request->is_employed;
            $data['organization_id'] = get_organization_id(auth()->guard('organization')->user());

            $employee = Teacher::create($data);
            return new DataSuccess(
                data: new OrganizationEmployeeResource($employee),
                status: true,
                message: 'Employee created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }


    public function update_employee($request): DataStatus
    {
        try {
            $employee = Teacher::where('id', $request->id)->first();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['gender'] = $request->gender;
            $data['age'] = $request->age;
            $data['is_employed'] = $request->is_employed;

            if ($request->hasFile('image')) {
                if ($employee->image && file_exists($employee->image)) {
                    delete_image($employee->image);
                }
                $image = upload_image($request->file('image'), 'employees');
                $data['image'] = $image;
            }
            $employee->update($data);

            return new DataSuccess(
                data: new OrganizationEmployeeResource($employee),
                status: true,
                message: 'Employee updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function fetch_employee_details($request): DataStatus
    {
        try {
            $employee = Teacher::where('id', $request->id)->first();
            return new DataSuccess(
                data: new OrganizationEmployeeResource($employee),
                status: true,
                message: 'Employee fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function delete_employee($request): DataStatus
    {
        try {
            $employee = Teacher::where('id', $request->id)->first();
            $employee->delete();
            return new DataSuccess(
                status: true,
                message: 'Employee deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function edit_employee_password($request): DataStatus
    {
        try {
            $employee = Teacher::where('id', $request->id)->first();
            $data['password'] = $request->password;
            $employee->update($data);
            return new DataSuccess(
                status: true,
                data: new OrganizationEmployeeResource($employee),
                message: 'Employee password updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
