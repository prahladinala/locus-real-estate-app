<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'id',
        'title',
        'email',
        'name',
        'review',
        'rating',
        'document',
        'listing_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function review_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function review_to_listing()
    {
        return $this->belongsTo(Listing::class,'listing_id','id');
    }

    public function get_user($id)
    {
        return User::find($id);
    }

}
