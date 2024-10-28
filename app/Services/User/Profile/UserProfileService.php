<?php

namespace App\Services\User\Profile;




use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Blog\Blog;
use App\Models\Organization\Blog\BlogHashtag;
use App\Http\Resources\User\Auth\UserLoginResource;
use App\Http\Resources\Organization\Blog\BlogResource;
use App\Http\Resources\User\Profile\UserProfileResource;
use App\Http\Resources\Organization\BlogHashtag\BlogHashtagResource;

class UserProfileService
{
    public function show()
    {
        try {
            $user = Auth('user')->user();
            return new DataSuccess(
                data: new UserProfileResource($user),
                statusCode: 200,
                message: 'Fetch User Profile successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function update($dataRequest): DataStatus
    {
        try {
            $user = Auth('user')->user();
            $data['name'] = $dataRequest['name'];
            $data['email'] = $dataRequest['email'];
            $data['phone'] = $dataRequest['phone'];
            if (isset($dataRequest['image'])) {
                if ($user->image) {
                    delete_image(old_image_path: $user->image, disk: 'public');
                }
                $data['image'] = upload_image(folder: 'users', image: $dataRequest['image']);
            }
            $user->update($data);
            return new DataSuccess(
                data: new UserLoginResource($user),
                status: true,
                message: 'User Profile Updated Successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
