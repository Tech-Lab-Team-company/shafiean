<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Storage;

class TeacherService
{
    public function getAllTeachers(): DataStatus
    {
        try {
            $teachers = Teacher::all();
            return new DataSuccess(
                data: TeacherResource::collection($teachers),
                statusCode: 200,
                message: 'Teachers retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Failed to retrieve teachers: ' . $e->getMessage()
            );
        }
    }

    public function getTeacherById($id): DataStatus
    {
        try {
            $teacher = Teacher::find($id);
            return new DataSuccess(
                data: new TeacherResource($teacher),
                statusCode: 200,
                message: 'Teacher retrieved successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 404,
                message: 'Teacher not found: ' . $e->getMessage()
            );
        }
    }

    public function createTeacher(array $data): DataStatus
    {
        try {
            if (isset($data['image'])) {
                $imagePath = upload_image('teachers', $data['image']);
                $data['image'] = $imagePath;
            } else {
                $data['image'] = 'uploads/default.jpg';
            }
            $teacher = Teacher::create($data);
            return new DataSuccess(
                data: new TeacherResource($teacher),
                statusCode: 200,
                message: 'Teacher created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Teacher creation failed: ' . $e->getMessage()
            );
        }
    }

    public function updateTeacher($id, array $data): DataStatus
    {
        try {
            $teacher = Teacher::find($id);

            if (isset($data['image'])) {
                if ($teacher->image !== 'uploads/default.jpg') {
                    Storage::delete($teacher->image);
                }
                $data['image'] = upload_image('public/teachers', $data['image']);
            }

            $teacher->update($data);

            return new DataSuccess(
                data: new TeacherResource($teacher),
                statusCode: 200,
                message: 'Teacher updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Teacher update failed: ' . $e->getMessage()
            );
        }
    }

    public function deleteTeacher($id): DataStatus
    {
        try {
            $teacher = Teacher::findOrFail($id);
            if ($teacher->image !== 'uploads/default.jpg') {
                Storage::delete($teacher->image);
            }
            $teacher->delete();

            return new DataSuccess(
                statusCode: 200,
                message: 'Teacher deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Teacher deletion failed: ' . $e->getMessage()
            );
        }
    }
}

