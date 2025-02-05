<?php

namespace App\Services\Organization\User;


use Exception;
use App\Models\User;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\Storage;
use App\Services\Organization\UserRelation\UserRelationService;

class UserService
{
    public function index($dataRequest): DataStatus
    {
        $query = User::query();
        if ($dataRequest->has('type') && $dataRequest->type !== null) {
            $query->where('type', $dataRequest->type);
        }
        $filter_service = new FilterService();
        if (isset($dataRequest)) {

            $filter_service->filterUsers($query, $dataRequest);
        }

        $users = $query->orderBy('id', 'desc')->paginate(5);

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
            (new UserRelationService())->storeParentRelation($dataRequest->relation_id, $user->id, $dataRequest->parent_id);
            if ($dataRequest['group_ids']) {
                $user->groups()->attach($dataRequest['group_ids']);
            }
            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: __('messages.success_create')
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
            // dd($user);
            $data = $this->userData($dataRequest, $user);
            $user->update($data);
            // (new UserRelationService())->updateParentRelation($dataRequest->relation_id, $user->id, $dataRequest->parent_id);
            if ($dataRequest['group_ids']) {
                $user->groups()->sync($dataRequest['group_ids']);
            }
            return new DataSuccess(
                data: new UserResource($user),
                statusCode: 200,
                message: __('messages.success_update')
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
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'User deletion failed: ' . $e->getMessage()
            );
        }
    }
    public function deleteUserImage($request): DataStatus
    {
        try {
            $user = User::whereId($request->id)->first();
            if ($user->image != null) {
                delete_image($user->image);
            }
            $user->update(['image' => null]);
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
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
            if ($user && $user->image && $user->image !== 'uploads/default.jpg') {
                delete_image($user->image);
            }
            $data['image'] = upload_image($dataRequest['image'], 'users');
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
