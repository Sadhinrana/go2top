<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class DripFeedOrders extends Model
{
    protected $table = 'drip_feed_orders';

    protected $fillable = [
            'user_id',
            'runs',
            'interval',
            'total_quantity',
            'total_charges',
            'status',
    ];

   public function orders()
   {
       return $this->hasMany(Order::class, 'drip_feed_id');
   }
}
