<?php

namespace App;

use App\SupportTicketComment;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';

    protected $fillable = [
        'subject',
        'subject_ids',
        'payment_type',
        'description',
        'status',
        'user_id',
        'send_by',
        'sender_role',
    ];
    
    public function comments()
    {
        return $this->morphMany(SupportTicketComment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
