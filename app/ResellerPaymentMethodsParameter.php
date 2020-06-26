<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerPaymentMethodsParameter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'reseller_payment_methods_parameters';
    protected $fillable = [
        'id','reseller_id', 'global_payment_methods_id', 'form_label', 'key', 'value', 'status', 'created_at', 'updated_at'
    ];
}
