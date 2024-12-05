<?php

namespace App\Models;

use App\Models\Surah\Surah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ayat extends Model
{
    use HasFactory;
    protected $table = 'ayat';

    protected $guarded = [];

    public function quraan()
    {
        return $this->belongsTo(Surah::class, 'surah_id');
    }
}
