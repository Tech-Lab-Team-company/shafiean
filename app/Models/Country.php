<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'countries';

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'country_id');
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, 'country_id');
    }
}
