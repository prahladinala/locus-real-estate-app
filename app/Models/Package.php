<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    protected $fillable = [
        'id',
        'name',
        'price',
        'package_type',
        'interval',
        'duration',
        'status',
        'description',
        'created_at',
        'updated_at',
    ];

    public function package_to_pendingsubscription()
    {
        return $this->hasMany(PendingSubscription::class,'package_id','id');
    }

    public function package_to_subscription()
    {
        return $this->hasMany(Subscription::class,'package_id','id');
    }

    public function package_to_subscriptionPayment()
    {
        return $this->hasMany(SubcriptionPayment::class,'package_id','id');
    }
}
