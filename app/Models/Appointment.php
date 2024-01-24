<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'id',
        'date',
        'type',
        'listing_id',
        'name',
        'phone',
        'email',
        'message',
        'customer_id',
        'agent_id',
        'zoom_meeting_link',
        'created_at',
        'updated_at',
    ];


    public function appointment_to_listing()
    {
        return $this->belongsTo(Listing::class,'listing_id','id');
    }

    public function appointment_to_customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function appointment_to_agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }

}
