<?php

namespace App\Services;

use App\Models\Curriculum;
use Illuminate\Support\Facades\DB;

class CurriculumService
{
    public function getAllCurriculums()
    {
        return Curriculum::all();
    }

    public function getCurriculumById($id)
    {
        return Curriculum::findOrFail($id);
    }

    public function createCurriculum($data)
    {
        return Curriculum::create($data);
    }

    public function updateCurriculum($id, $data)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->update($data);
        return $curriculum;
    }

    public function deleteCurriculum($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->delete();
    }
}

