<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicketComment extends Model
{
    protected $table = 'support_ticket_comments';
    protected $fillable =  [
        'message',
        'commentable_id',
        'commentable_type',
        'comment_by',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'comment_by');
    }
}
