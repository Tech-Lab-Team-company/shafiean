<?php

namespace App\Models\Admin;

use Laravel\Sanctum\HasApiTokens;
use Database\Factories\AdminFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;
    protected $table = 'admins';
    protected $guard = 'admin';
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
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
