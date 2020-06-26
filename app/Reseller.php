<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResellerResetPasswordNotification;
use App\Notifications\ResellerEmailVerificationNotification;

class Reseller extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
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
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResellerResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new ResellerEmailVerificationNotification());
    }

    /**
     * Get the category record associated with the client.
     */
    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    /**
     * Get the service record associated with the client.
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * Get the statuses record associated with the client.
     */
    public function statuses()
    {
        return $this->hasMany('App\Status');
    }

    /**
     * Get the messages record associated with the client.
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * Get the settings record associated with the client.
     */
    public function settings()
    {
        return $this->hasOne('App\Setting');
    }

    /**
     * Get the settings record associated with the client.
     */
    public function domains()
    {
        return $this->hasMany('App\Domain');
    }

    /**
     * Get the users record associated with the client.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the exported_users record associated with the client.
     */
    public function exported_users()
    {
        return $this->hasMany('App\ExportedUser');
    }

    /**
     * Get the payments record associated with the client.
     */
    public function payments()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * Get the exported_payments record associated with the client.
     */
    public function exported_payments()
    {
        return $this->hasMany('App\ExportedPayment');
    }

    /**
     * Get the paymentMethods record associated with the client.
     */
    public function paymentMethods()
    {
        return $this->hasMany('App\ResellerPaymentMethodsSetting');
    }

    /**
     * Get the paymentMethods record associated with the client.
     */
    public function exportedOrders()
    {
        return $this->hasMany('App\ExportedOrder');
    }
}
