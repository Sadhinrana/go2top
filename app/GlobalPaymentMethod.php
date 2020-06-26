<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalPaymentMethod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'fields', 'status', 'created_at', 'updated_at'
    ];
}
