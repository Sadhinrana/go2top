<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSettingGeneral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'keyword', 'value', 'setting_type', 'created_at', 'updated_at'
    ];
}
