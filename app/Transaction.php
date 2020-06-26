<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'transaction_type',
        'amount',
        'transaction_flag',
        'user_id',
        'admin_id',
        'status',
        'memo',
        'fraud_risk',
        'transaction_detail',
        'payment_gateway_response',
        'reseller_payment_methods_setting_id',
        'reseller_id',
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function resellerPaymentMethodsSetting()
    {
        return $this->belongsTo('App\ResellerPaymentMethodsSetting');
    }
}
