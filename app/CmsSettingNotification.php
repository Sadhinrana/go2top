<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSettingNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'subject', 'body', 'title', 'description', 'type', 'status', 'created_at', 'updated_at'
    ];
}
