<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the ticket that owns the comment.
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
