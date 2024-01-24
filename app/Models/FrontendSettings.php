<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendSettings extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'frontend_settings';
    protected $fillable = [
        'id',
        'type',
        'description',
     
    ];
}
