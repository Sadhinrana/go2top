<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table ='providers';
    protected $fillable = [
        'domain', 'api_url', 'api_key', 'status'
    ];
}
