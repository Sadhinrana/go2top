<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSettingBonuse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'bonus_amount', 'global_payment_method_id', 'deposit_from', 'status', 'created_at', 'updated_at'
    ];
}
