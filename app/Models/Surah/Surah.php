<?php

namespace App\Models\Surah;

use App\Models\Ayah;
use App\Models\Ayat;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Surah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'surahs';
    public function stages(): BelongsToMany
    {
        return $this->belongsToMany(Stage::class, 'stage_surahs', 'surah_id', 'stage_id');
    }
    public function ayahs(): HasMany
    {
        return $this->hasMany(Ayah::class, 'surah_id', 'id');
    }
}
