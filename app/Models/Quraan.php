<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quraan extends Model
{
    use HasFactory, SoftDeletes;
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

