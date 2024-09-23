<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends  = ["image_link"];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
}
