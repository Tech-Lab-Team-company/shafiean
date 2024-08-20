<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'timestamp',
        'title',
        'stage_id',
        'order',
        'type',
        'organization_id'

    ];
    protected $table = 'terms';
    public $timestamps = true;
    public function stage() : BelongsTo
    {
        return $this->belongsTo('Stage', 'stage_id');
    }
}

