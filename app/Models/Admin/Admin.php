<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    use HasFactory;
    protected $table = "admins";

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'api_key',
        'job_title'
    ];

    public function admin_Histories() : HasMany
    {
        return $this->hasMany(AdminHistory::class, 'admin_id');
    }
}

