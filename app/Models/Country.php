<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'id',
        'name',
        'code',
        'dial_code',
        'currency_name',
        'currency_symbol',
        'currency_code',
        'created_at',
        'updated_at',
    ];

    public function country_to_state()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function country_to_city()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
