<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

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
