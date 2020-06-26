<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportedOrder extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'include_columns' => 'array',
        'user_ids' => 'array',
        'service_ids' => 'array',
        'provider_ids' => 'array',
        'status' => 'array',
    ];
}
