<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPaymentSettings extends Model
{
    use HasFactory;
    protected $table = 'agent_payment_keys';

    protected $fillable = [ 'id','name', 'payment_keys','image','status','mode','created_at','updated_at','user_id' ];


    public function agent_payment_keys_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
