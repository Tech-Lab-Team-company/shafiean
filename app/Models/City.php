<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = ['title', 'country_id'];

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function users() : HasMany
    {
        return $this->hasMany(User::class , 'user_id');
    }

    public function organizations() : HasMany
    {
        return $this->hasMany(Organization::class, 'city_id');
    }
}
