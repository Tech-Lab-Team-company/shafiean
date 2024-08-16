<?php

namespace App\Services;

use App\Models\City;

class CityService
{
    public function getAllCities()
    {
        return City::all();
    }

    public function createCity(array $data)
    {
        return City::create($data);
    }

    public function getCityById($id)
    {
        return City::findOrFail($id);
    }

    public function updateCity($id, array $data)
    {
        $city = City::findOrFail($id);
        $city->update($data);
        return $city;
    }

    public function deleteCity($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }
}

