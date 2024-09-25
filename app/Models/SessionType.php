<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'session_types';

    public function main_sessions()
    {
        return $this->hasMany(MainSession::class, 'session_type_id');
    }
}
