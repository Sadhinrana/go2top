<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the ticket.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments record associated with the ticket.
     */
    public function comments()
    {
        return $this->hasMany('App\TicketComment');
    }
}
