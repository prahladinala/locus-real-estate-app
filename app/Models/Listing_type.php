<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Termwind\Components\Li;

class Listing_type extends Model
{
    use HasFactory;
    protected $table = 'listing_types';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'thumbnail',
        'status',
        'order',
        'created_at',
        'updated_at',

    ];



    public function listingtype_to_attribute()
    {
        return $this->hasMany(Listing_attribute::class,'listing_type_id','id');
    }
    public function listingtype_to_listing()
    {
        return $this->hasMany(Listing::class,'listing_type_id','id');
    }
}
