<?php

namespace App\Services\Organization\Employee;


use Exception;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Teacher;
use App\Enum\EmployeeTypeEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Resources\OrganizationEmployeeResource;
use App\Services\Organization\Employee\EmployeeImageService;

class EmployeeService
{

    public function fetch_employees($request): DataStatus
    {
        try {
            $query = Teacher::where('organization_id', get_organization_id(auth()->guard('organization')->user()))->where('is_employed', 0);
            $filter_service = new FilterService();
            if (isset($request)) {
                $filter_service->filterTeachers($query, $request);
            }

            $employees = $query->orderBy('id', 'desc')->paginate(10);
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
            $data['gender'] = array_key_exists('gender', $request->all()) ? $request->gender : null;
            $data['age'] = array_key_exists('age', $request->all()) ? $request->age : null;
            $data['is_employed'] = (isset($request->make_employee) && $request->make_employee == 1) ? 0 :  $request->is_employed;
            $data['marital_status'] = array_key_exists('marital_status', $request->all()) ? $request->marital_status : null;
            $data['identity_type'] = array_key_exists('identity_type', $request->all()) ? $request->identity_type : null;
            $data['identity_number'] = array_key_exists('identity_number', $request->all()) ? $request->identity_number : null;
            $data['date_of_birth'] = array_key_exists('date_of_birth', $request->all()) ? Carbon::parse($request->date_of_birth)->format('Y-m-d') : null;
            $data['organization_id'] = get_organization_id(auth()->guard('organization')->user());
            $data['job_type_id'] = array_key_exists('job_type_id', $request->all()) ? $request->job_type_id : null;
            $employee = Teacher::create($data);

            if ($request->certificate_images) (new EmployeeImageService())->storeCertificateImage(null, $employee, $request);

            if (isset($request->curriculum_ids)) {
                $employee->curriculums()->attach($request->curriculum_ids);
            }
            return new DataSuccess(
                data: new OrganizationEmployeeResource($employee),
                status: true,
                message: __('messages.success_create')
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
            $data['is_employed'] = ((isset($request->make_employee) && $request->make_employee == 1) ? 0 : $request->is_employed) ?? $employee->is_employed;
            $data['marital_status'] = $request->marital_status ?? $employee->marital_status;
            $data['identity_type'] = $request->identity_type ?? $employee->identity_type;
            $data['identity_number'] = $request->identity_number ?? $employee->identity_number;
            $data['date_of_birth'] = $request->date_of_birth ? Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->format('Y-m-d') : $employee->date_of_birth;
            $data['job_type_id'] = $request->job_type_id;
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
                message: __('messages.success_update')
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
                message: __('messages.success_delete')
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
                message: __('messages.success_update')
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
            $query = Teacher::where('organization_id', get_organization_id(auth()->guard('organization')->user()))->where('is_employed', EmployeeTypeEnum::TEACHER->value);
            $filter_service = new FilterService();
            if (isset($request)) {
                $filter_service->filterTeachers($query, $request);
            }

            $teachers = $query->orderBy('id', 'desc')->paginate(10);
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
