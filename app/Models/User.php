<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'name',
        'email',
        'address',
        'phone',
        'website',
        'social',
        'about',
        'password',
        'role',
        'wishlists',
        'verification_code',
        'is_verified',
        'email_verified_at',
        'is_customer',
        'is_agent',
        'image',
        'archive',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_to_listings()
    {
        return $this->hasMany(Listing::class,'user_id','id');
    }

    public function user_to_pendingsubscription()
    {
        return $this->hasOne(PendingSubscription::class,'user_id','id');
    }

    public function user_to_subscription()
    {
        return $this->hasMany(Subscription::class,'user_id','id');
    }

    public function user_to_review()
    {
        return $this->hasMany(Review::class,'user_id','id');
    }

    public function customer_to_appointment()
    {
        return $this->hasMany(Appointment::class,'customer_id','id');
    }

    public function agent_to_appointment()
    {
        return $this->hasMany(Appointment::class,'agent_id','id');
    }

    public function user_to_payment_keys()
    {
        return $this->hasMany(AgentPaymentSettings::class,'user_id','id');
    }

    public function user_to_sender()
    {
        return $this->hasMany(MessageThread::class,'sender','id');
    }

    public function user_to_receiver()
    {
        return $this->hasMany(MessageThread::class,'receiver','id');
    }

    public function user_to_subscriptionPayment()
    {
        return $this->hasMany(SubcriptionPayment::class,'user_id','id');
    }

    public function user_to_agentReview()
    {
        return $this->hasMany(AgentReview::class,'user_id','id');
    }

    public function agent_to_agentReview()
    {
        return $this->hasMany(AgentReview::class,'agent_id','id');
    }

    public function user_to_blog()
    {
        return $this->hasMany(Blog::class,'user_id','id');
    }

    public function get_country($code)
    {
        $name=Country::where('code',$code)->first();

        return $name->name;
    }

}
