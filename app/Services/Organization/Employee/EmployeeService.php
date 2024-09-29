<?php

namespace App\Services\Organization\Employee;


use Exception;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Teacher;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\OrganizationEmployeeResource;
use App\Services\Organization\Employee\EmployeeImageService;

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
            // dd($request->certificate_images);
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
            $data['marital_status'] = $request->marital_status;
            $data['identity_type'] = $request->identity_type;
            $data['identity_number'] = $request->identity_number;
            $data['date_of_birth'] = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->format('Y-m-d');;
            $data['organization_id'] = get_organization_id(auth()->guard('organization')->user());
            $employee = Teacher::create($data);

            if ($request->certificate_images) (new EmployeeImageService())->storeCertificateImage(null, $employee, $request);

            if (isset($request->curriculum_ids)) {
                $employee->curriculums()->attach($request->curriculum_ids);
            }
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
            $data['name'] = $request->name ?? $employee->name;
            $data['email'] = $request->email ?? $employee->email;
            $data['phone'] = $request->phone ?? $employee->phone;
            $data['gender'] = $request->gender ?? $employee->gender;
            $data['age'] = $request->age ?? $employee->age;
            $data['is_employed'] = $request->is_employed ?? $employee->is_employed;
            $data['marital_status'] = $request->marital_status ?? $employee->marital_status;
            $data['identity_type'] = $request->identity_type ?? $employee->identity_type;
            $data['identity_number'] = $request->identity_number ?? $employee->identity_number;
            $data['date_of_birth'] = $request->date_of_birth ? Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->format('Y-m-d') : $employee->date_of_birth;
            if ($request->hasFile('image')) {
                if ($employee->image && file_exists($employee->image)) {
                    delete_image($employee->image);
                }
                $image = upload_image($request->file('image'), 'employees');
                $data['image'] = $image;
            }
            $employee->update($data);
            if (isset($request->curriculum_ids)) {
                $employee->curriculums()->sync($request->curriculum_ids);
            }
            if ($request->certificate_images) (new EmployeeImageService())->storeCertificateImage($request->old_images, $employee, $request);

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

    public function fetch_teachers($request): DataStatus
    {
        try {
            $teachers = Teacher::where('organization_id', get_organization_id(auth()->guard('organization')->user()))->where('is_employed', 1)->paginate(10);
            return new DataSuccess(
                data: OrganizationEmployeeResource::collection($teachers)->response()->getData(true),
                status: true,
                message: 'Teachers fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
