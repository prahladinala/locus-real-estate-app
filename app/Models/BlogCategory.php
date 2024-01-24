<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	use HasFactory;
    protected $table = 'blog_category';
    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function blogCategory_to_blog()
    {
        return $this->hasMany(Blog::class,'blog_category_id','id');
    }
}