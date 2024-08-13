<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'licence_number',
        'phone',
        'email',
        'address',
        'country_id',
        'city_id',
        'manager_name',
        'manager_phone',
        'manager_email',
    ];

    // Define the relationship with Teacher model
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}

