<?php

namespace App\Models\Surah;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'surahs';
}
