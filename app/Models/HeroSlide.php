<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSlide extends Model
{
    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'is_active',
        'order',
    ];
}

