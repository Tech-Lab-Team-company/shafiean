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
}
