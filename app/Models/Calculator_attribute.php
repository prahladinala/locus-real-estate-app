<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator_attribute extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'calculator_attribute';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'attribute_type','conditions','orders'
    ];
}
