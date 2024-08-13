<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'gender',
        'api_key',
        'age',
        'image',
        'organization_id',
    ];

    // Define the relationship with Organization model
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
