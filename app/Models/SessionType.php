<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'session_types';

    public function main_sessions()
    {
        return $this->hasMany(MainSession::class, 'session_type_id');
    }
}
