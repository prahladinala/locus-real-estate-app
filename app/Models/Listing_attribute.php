<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_attribute extends Model
{
    use HasFactory;
    protected $table = 'listing_attributes';
    protected $fillable = [
        'id',
        'listing_type_id',
        'attribute_name',
        'created_at',
        'updated_at',

    ];

    public function attribute_to_listingtype()
    {
        return $this->belongsTo(Listing_type::class,'listing_type_id','id');
    }

    public function attribute_to_attributetype()
    {
        return $this->hasMany(Listing_arrtibute_type::class,'listring_attribute_id','id');
    }
}
