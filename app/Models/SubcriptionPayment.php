<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcriptionPayment extends Model
{
    use HasFactory;
    protected $table = 'subscription_payments';
    protected $fillable = [
        'id',
        'expense_type',
        'package_id',
        'user_id',
        'payment_method',
        'amount',
        'status',
        'transaction_keys',
        'created_at',
        'updated_at',
    ];

    public function subscriptionPayment_to_package()
    {
        return $this->belongsTo(Package::class,'package_id','id');
    }

    public function subscritionPayment_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
