<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

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
