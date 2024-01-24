<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'id',
        'blog_category_id',
        'user_id',
        'title',
        'description',
        'thumbnail',
        'is_popular',
        'likes',
        'status',
        'keywords',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'og_title',
        'og_description',
        'json_ld',
        'og_image',
        'canonical'
    ];

    public function blog_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function blog_to_category()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id','id');
    }
}