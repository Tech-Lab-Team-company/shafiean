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
    public function index(): DataStatus
    {
        // $users = User::all();
        $users = User::where('organization_id', get_organization_id(auth()->guard('organization')->user()))->paginate(10);

        return new DataSuccess(
            data: UserResource::collection($users),
            statusCode: 200,
            message: 'User updated successfully'
        );
    }

    public function show($request): DataStatus
    {
        $user = User::whereId($request->id)->first();
        // dd($user);
        return new DataSuccess(
            data: new UserResource($user),
            statusCode: 200,
            message: 'Fetch User successfully'
        );
    }
    public function store(array $data): DataStatus
    {
        try {
            $organizationId = get_organization_id(auth()->guard('organization')->user());
            if (isset($data['image'])) {
                $data['image'] = upload_image($data['image'], 'users');
            } else {
                $data['image'] = 'uploads/default.jpg';
            }
            $data['organization_id'] = $organizationId;
            $user = User::create($data);
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

    public function update(array $data): DataStatus
    {
        try {
            $user = User::whereId($data['id'])->first();
            if (isset($data['image'])) {
                if ($user->image !== 'uploads/default.jpg') {
                    Storage::delete($user->image);
                }
                $data['image'] = upload_image('users', $data['image']);
            }

            $user->update($data);

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
}
