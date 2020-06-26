<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the category that owns the service.
     */
    public function category()
    {
        return $this->belongsTo('App\Category','service_id','id');
    }

    /**
     * Get the users list associated with the service.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get the users list associated with the service.
     */
    public function clients()
    {
        return $this->belongsToMany('App\User', 'service_price_user', 'service_id', 'user_id')
            ->withPivot('price');
    }

    public function getModeTitleAtrribute()
    {
        return ucfirst($this->mode);
    }
}
