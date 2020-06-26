<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsStaffEmail extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'email', 'payment_received', 'new_manual_orders', 'fail_orders', 'new_messages', 'new_manual_payout', 'created_at', 'updated_at'
    ];
}
