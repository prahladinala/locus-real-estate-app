<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_arrtibute_type extends Model
{
    use HasFactory;
    protected $table = 'listing_arrtibute_types';
    protected $fillable = [
        'id',
        'listring_attribute_id',
        'type',
        'slug',
        'font_awesome_class',
        'property_image',
        'created_at',
        'updated_at',

    ];

    public function attributetype_to_attribute()
    {
        return $this->belongsTo(Listing_attribute::class,'listing_type_id','id');
    }

    public function attributetype_to_value($listing_id)
    {
        return $this->hasMany(Listing_attribute_value::class, 'listing_attribute_type_id', 'id')
                    ->where('listing_id', $listing_id);
    }

    public function listing_attribute_type_to_listing()
    {
        return $this->hasMany(Listing::class,'listing_attribute_type_id','id');
    }

}
