<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;
    protected $table = 'addons';
    protected $fillable = [
        'id',
        'unique_identifier',
        'title',
        'version',
        'purchese_code',
        'status',
        'created_at',
        'updated_at',
    ];

}
