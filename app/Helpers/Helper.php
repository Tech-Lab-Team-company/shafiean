<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('upload_image')) {


    function upload_image($folder ,$image )
    {
        if (isset($image)) {
            $path = Storage::putFile($folder, $image);
            $urlImage = Storage::url($path);
            return $urlImage;
        }
    }
}



