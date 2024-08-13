<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityType extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'order', 'string'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
