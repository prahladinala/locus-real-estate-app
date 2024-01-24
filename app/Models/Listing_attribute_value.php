<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_attribute_value extends Model
{
    use HasFactory;
    protected $table = 'listing_attribute_values';
    protected $fillable = [
        'id',
        'listing_attribute_type_id',
        'value',
        'listing_id'.
        'created_at',
        'updated_at',

    ];

    public function attribute_value_to_attribute_type()
    {
        return $this->belongsTo(Listing_arrtibute_type::class,'listing_attribute_type_id','id');
    }

    public function listing_to_listing_attribute_type_values()
    {
        return $this->belongsTo(Listing::class,'listing_id','id');
    }






}
