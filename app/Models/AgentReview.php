<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentReview extends Model
{
    use HasFactory;
    protected $table = 'agent_review';
    protected $fillable = [
        'id',
        'user_id',
        'agent_id',
        'name',
        'review',
        'rating',
        'document',
        'dislike',
        'like',
        'created_at',
        'updated_at',
    ];

    public function agentReview_to_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function agentReview_to_agent()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }


    public function get_user($id)
    {
        return User::find($id);
    }
}
