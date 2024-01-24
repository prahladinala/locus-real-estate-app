<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscriptions';
    protected $fillable = [
        'id',
        'user_id',
        'package_id',
        'paid_amount',
        'payment_method',
        'transaction_keys',
        'expire_date',
        'status',
        'created_at',
        'updated_at',
    ];



    public function subscription_to_package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function subscription_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
