<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;
    protected $table = "organizations";

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

    public function teachers() :HasMany
    {
        return $this->hasMany(Teacher::class , 'organization_id');
    }
}

