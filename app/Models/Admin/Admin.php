<?php

namespace App\Models\Admin;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable , HasApiTokens ;
    protected $table = 'admins';
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'api_key', 'job_title','api_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static function newFactory()
    {
        return AdminFactory::new();
    }
    protected function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }
    public function adminHistories(): HasMany
    {
        return $this->hasMany(AdminHistory::class, 'admin_id');
    }
}



