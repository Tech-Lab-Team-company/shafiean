<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quraan extends Model
{
    use HasFactory;
    protected $table = 'quraan';

    protected $fillable = [
        'title',
        'order',
        'type',
    ];

    public function stages(){

        return $this->belongsToMany(Stage::class, 'stage_quraan', 'quraan_id', 'stage_id');
    }
}

