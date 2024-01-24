<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingSubscription extends Model
{
    use HasFactory;
    protected $table = 'pending_subscriptions';
    protected $fillable = [
        'id',
        'payment_type',
        'user_id ',
        'package_id ',
        'price',
        'transaction_keys',
        'document_image',
        'paid_by',
        'status',
        'created_at',
        'updated_at',
    ];

    

    public function pendingsubscription_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function pendingsubscription_to_package()
    {
        return $this->belongsTo(package::class,'package_id','id');
    }

}
