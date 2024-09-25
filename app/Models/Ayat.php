<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ayat extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ayat';

    protected $fillable = [
        'quraan_id',
        'number',
    ];

    public function quraan()
    {
        return $this->belongsTo(Quraan::class, 'quraan_id');
    }
}
