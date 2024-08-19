<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{
    use HasFactory;
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
