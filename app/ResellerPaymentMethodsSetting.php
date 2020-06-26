<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResellerPaymentMethodsSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','reseller_id', 'global_payment_method_id', 'method_name', 'minimum', 'maximum', 'new_user_status', 'visibility', 'sort','created_at', 'updated_at'
    ];

    /**
     * Get the users list associated with the paymentMethod.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
