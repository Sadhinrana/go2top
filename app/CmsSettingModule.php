<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSettingModule extends Model
{
    protected $fillable = [
        'id','reseller_id', 'amount', 'commission_rate', 'approve_payout', 'type', 'status', 'created_at', 'updated_at'
    ];
}
