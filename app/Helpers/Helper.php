<?php

use App\Models\Organization;
use Intervention\Image\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;

if (!function_exists('upload_image')) {

    function upload_image($image, $folder, $disk = 'public')
    {
        $img = Image::read($image);
        $name = rand(10, 100000) . time() . $image->getClientOriginalName();
        $upload_path = 'uploads/' . $folder;
        $image_url = $upload_path . '/' . $name;
        // Encode the image to the desired format based on the mime type
        $encodedImage = $img->encode();
        Storage::disk($disk)->put($image_url, (string) $encodedImage); // Cast to string to ensure correct saving
        return $image_url;
        // Storage::disk($disk)->url($image_url); // this for the full url of the image
    }
    function delete_image($old_image_path, $disk = 'public')
    {
        // Delete the old image from the specified disk
        Storage::disk($disk)->delete($old_image_path);
    }
    function uploadFile($file, $folder, $disk = 'public')
    {
        $fileName = time() . rand(1, 9999) . '.' . $file->getClientOriginalExtension();
        $uploadPath = 'uploads/' . $folder;
        $fileUrl = $uploadPath . '/' . $fileName;
        Storage::disk($disk)->putFileAs($uploadPath, $file, $fileName);
        return $fileUrl;
    }
    function deleteFile($filePath, $disk = 'public')
    {
        Storage::disk($disk)->delete($filePath);
    }

    function get_organization_id($user = null)
    {

        return $user->organization_id;
    }

    function get_auth_organization_id()
    {
        return auth()->user()->organization_id ?? checkWebsiteLink(request()); // Returns null if no organization is found
    }
    function checkWebsiteLink($request)
    {
        $websiteLink = $request->header("website-link");

        if ($websiteLink == null) {
            throw new \Exception("Website Link is required in Header", 400);
        }
        $organization = Organization::whereWebsiteLink($websiteLink)->first();

        if ($organization) {
            return $organization->id;
        }

        throw new \Exception("website link is invaild", 400);
    }
    function enumCaseValue($enum)
    {
        $values = array_map(fn($case) => $case->value, $enum::cases());
        return implode(',', $values);
    }
    function hashApiToken()
    {
        return Hash::make(rand(99, 99999999));
    }
    function sanctumApiToken(Model $model, string $name)
    {
        return $model->createToken($name)->plainTextToken;
    }
}
