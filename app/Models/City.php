<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'country_id',
        'state_id',
        'is_featured',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function city_to_country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city_to_state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function city_to_listings()
    {
        return $this->hasMany(Listing::class,'city_id','id');
    }


}
