<?php

namespace App\Services\Organization\Employee;

use App\Models\Image;
use App\Models\Teacher;

class EmployeeImageService
{
    public function storeCertificateImage($oldImages, $employee, $request)
    {
        $this->deleteOldImages($request->old_images, $employee);
        foreach ($request->certificate_images as $image) {
            $image_data['imageable_id'] = $employee->id;
            $image_data['imageable_type'] = Teacher::class;
            if (is_file($image)) {
                $image_data['image'] = upload_image($image, 'employees');
            }
            Image::create($image_data);
        }
    }
    private function deleteOldImages($oldImages, $employee)
    {
        if (!is_array($oldImages)) $oldImages = [];
        $images = $employee->images()->get();
        foreach ($images as $image) {
            if (in_array($image->id, $oldImages)) {
                $image->delete();
                delete_image($image->image);
            }
        }
    }
}
