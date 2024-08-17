<?php

namespace App\Services;

use App\Models\Teacher;

class TeacherService
{
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getTeacherById($id)
    {
        return Teacher::findOrFail($id);
    }

    public function createTeacher($data)
    {
        if (isset($data['image'])) {

            $imagePath = upload_image('public/teachers', $data['image']);
            $data['image'] = $imagePath;
        } else {
            $data['image'] = 'uploads/default.jpg';
        }
        return Teacher::create($data);
    }

    public function updateTeacher($id, $data)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($data);
        return $teacher;
    }

    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
    }
}

