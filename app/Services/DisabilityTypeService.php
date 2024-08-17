<?php

namespace App\Services;

use App\Models\DisabilityType;

class DisabilityTypeService
{
    public function getAll()
    {
        return DisabilityType::all();
    }

    public function getById($id)
    {
        return DisabilityType::findOrFail($id);
    }

    public function create(array $data)
    {
        return DisabilityType::create($data);
    }

    public function update(DisabilityType $disabilityType, array $data)
    {
        $disabilityType->update($data);
        return $disabilityType;
    }

    public function delete(DisabilityType $disabilityType)
    {
        return $disabilityType->delete();
    }
}

