<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $fillable = [
        'id',
        'title',
        'slug',
        'country_id',
        'thumbnail',
        'created_at',
        'updated_at',
    ];

    public function state_to_country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function state_to_city()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }
}
