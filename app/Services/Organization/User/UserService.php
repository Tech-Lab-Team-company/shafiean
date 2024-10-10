<?php

namespace App\Services\Organization\User;


use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function index($dataRequest): DataStatus
    {
        $users = User::query();
        if ($dataRequest->has('type') && $dataRequest->type !== null) {
            $users->where('type', $dataRequest->type);
        }
        $users = $users->orderBy('id', 'desc')->paginate(5);

        return new DataSuccess(
            data: UserResource::collection($users)->response()->getData(true),
            statusCode: 200,
            message: 'User updated successfully'
        );
    }

    public function show($request): DataStatus
    {
        $user = User::whereId($request->id)->first();
        return new DataSuccess(
            data: new UserResource($user),
            statusCode: 200,
            message: 'Fetch User successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = $this->userData($dataRequest);
            $user = User::create($data);
            if ($dataRequest['group_ids']) {
                $user->groups()->attach($dataRequest['group_ids']);
            }
            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: 'User created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User creation failed: ' . $e->getMessage()
            );
        }
    }

    public function update(object $dataRequest): DataStatus
    {
        try {
            $user = User::whereId($dataRequest['id'])->first();
            $data = $this->userData($dataRequest, $user);
            $user->update($data);
            if ($dataRequest['group_ids']) {
                $user->groups()->sync($dataRequest['group_ids']);
            }
            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: 'User updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User update failed: ' . $e->getMessage()
            );
        }
    }

    public function delete($request): DataStatus
    {
        try {
            $user = User::whereId($request->id)->first();
            if ($user->image !== 'uploads/default.jpg') {
                Storage::delete($user->image);
            }
            $user->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'User deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User deletion failed: ' . $e->getMessage()
            );
        }
    }
    private function userData($dataRequest, $user = null)
    {
        $organizationId = get_organization_id(auth()->guard('organization')->user());
        if (isset($dataRequest['image'])) {
            if ($user && $user->image !== 'uploads/default.jpg') {
                delete_image(old_image_path: $user->image, disk: 'public');
            }
            $data['image'] = upload_image($dataRequest['image'], 'users');
        } else {
            $data['image'] = 'uploads/default.jpg';
        }
        $data['organization_id'] = $organizationId;
        $data['name'] = $dataRequest['name'];
        $data['email'] = $dataRequest['email'];
        $data['password'] = $dataRequest['password'];
        $data['phone'] = $dataRequest['phone'];
        $data['date_of_birth'] = $dataRequest['date_of_birth'];
        $data['address'] = $dataRequest['address'];
        $data['gender'] = $dataRequest['gender'];
        $data['type'] = $dataRequest['type'];
        $data['country_id'] = $dataRequest['country_id'];
        $data['blood_type_id'] = $dataRequest['blood_type_id'];
        $data['identity_type'] = $dataRequest['identity_type'];
        $data['identity_number'] = $dataRequest['identity_number'];
        $data['api_key'] = $dataRequest['api_key'];
        return $data;
    }
}
