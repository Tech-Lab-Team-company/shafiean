<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
    public function getAllCountries()
    {

        return Country::all();
    }

    public function createCountry(array $data)
    {
        return Country::create($data);
    }

    public function getCountryById($id)
    {
        return Country::findOrFail($id);
    }

    public function updateCountry($id, array $data)
    {
        $country = Country::findOrFail($id);
        $country->update($data);
        return $country;
    }

    public function deleteCountry($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
    }
}

