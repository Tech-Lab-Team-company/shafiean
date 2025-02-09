<?php

namespace App\Models\Admin;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Admin\AdminHistory;
use Database\Factories\AdminFactory;
use Illuminate\Support\Facades\Hash;
use Laratrust\Contracts\LaratrustUser;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements LaratrustUser
{

    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, HasRolesAndPermissions;
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
