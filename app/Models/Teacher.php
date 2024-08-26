<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable , HasApiTokens ;
    protected $table = 'teachers';
    protected $guard = 'teacher';
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
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class , 'organization_id');
    }
}
