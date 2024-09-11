<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

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

    function get_organization_id($user = null)
    {

        return $user->organization_id;
    }
}
