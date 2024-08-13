<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'password', 'api_key', 'job_title',
    ];

    public function adminHistories()
    {
        return $this->hasMany(AdminHistory::class, 'admin_id');
    }
}

