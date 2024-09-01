<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload_image')) {


    function upload_image($folder, $image)
    {
        if (isset($image)) {
            $path = Storage::putFile('public/' . $folder, $image);
            $urlImage = Storage::url($path);
            return $urlImage;
        }
    }

    function delete_image($old_image_path, $disk = 'public')
    {
        // Delete the old image from the specified disk
        Storage::disk($disk)->delete($old_image_path);
    }
}
