<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    //
    protected $fillable = [
        'details'
        ,'currency_code'
        ,'currency_code'
        ,'total_amount'
        ,'global_payment_method_id'
        ,'user_id'
    ];
}
