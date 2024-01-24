<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetaTag extends Model
{
    use HasFactory;

    protected $fillable = [ 'route', 'name_route', 'title', 'keywords', 'description', 'url','json_ld','og_title','og_description','og_image','canonical' ];

}
