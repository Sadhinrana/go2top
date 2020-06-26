<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'status',
        'skype_name',
        'api_key',
        'referral_key',
        'password',
        'reseller_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the tickets record associated with the client.
     */
    public function tickets()
    {
        return $this->hasMany('App\SupportTicket');
    }

    public function balance()
    {
        if ($this->balance == null) {
            return PaymentLog::where('user_id', $this->id)->sum('total_amount');
        }
        return  $this->balance;
    }

    /**
     * Get the services list associated with the user.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    /**
     * Get the services list associated with the user.
     */
    public function servicesList()
    {
        return $this->belongsToMany('App\Service', 'service_price_user', 'user_id', 'service_id')
            ->withPivot('price');
    }

    /**
     * Get the orders record associated with the client.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the paymentMethods list associated with the user.
     */
    public function paymentMethods()
    {
        return $this->belongsToMany('App\ResellerPaymentMethodsSetting');
    }
}
