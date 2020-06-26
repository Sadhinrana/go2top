<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderService extends Model
{
    protected $table ='provider_services';
    protected $fillable = [
        'service_id', 
        'provider_id', 
        'provider_service_id', 
        'name',
        'type',
        'category',
        'rate',
        'min',
        'max',
    ];
}
