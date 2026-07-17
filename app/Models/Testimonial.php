<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_name',
        'trip_date',
        'rating',
        'message',
        'avatar_path',
        'package_id',
        'order',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}

