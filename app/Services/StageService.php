<?php

namespace App\Services;

use App\Models\Stage;
use Illuminate\Support\Facades\DB;

class StageService
{
    public function getAllStages()
    {
        return Stage::all();
    }

    public function getStageById($id)
    {
        return Stage::findOrFail($id);
    }

    public function createStage($data)
    {
        return Stage::create($data);
    }

    public function updateStage($id, $data)
    {
        $stage = Stage::findOrFail($id);
        $stage->update($data);
        return $stage;
    }

    public function deleteStage($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return $stage;
    }
}

