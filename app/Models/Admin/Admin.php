<?php

namespace App\Models\Admin;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'api_key',
        'job_title',
    ];

    protected static function newFactory()
    {
        return AdminFactory::new();
    }

    public function adminHistories(): HasMany
    {
        return $this->hasMany(AdminHistory::class, 'admin_id');
    }
}



