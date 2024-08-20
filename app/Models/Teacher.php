<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';

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

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class , 'organization_id');
    }
}
