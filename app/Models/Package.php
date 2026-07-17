<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'duration',
        'difficulty',
        'max_people',
        'description',
        'itinerary',
        'meeting_point',
        'facilities',
        'cover_image',
    ];
}

