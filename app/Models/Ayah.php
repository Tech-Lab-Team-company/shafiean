<?php

namespace App\Models;

use App\Models\Surah\Surah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ayah extends Model
{
    use HasFactory;
    protected $table = 'ayahs';

    protected $guarded = [];

    public function surah(): BelongsTo
    {
        return $this->belongsTo(Surah::class, 'surah_id');
    }
}
