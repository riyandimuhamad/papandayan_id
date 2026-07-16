<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'thumbnail_path',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'author_id',
        'status',
        'published_at',
        'view_count',
        'order',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
