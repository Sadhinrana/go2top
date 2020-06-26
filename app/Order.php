<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'order_id',
        'status',
        'charges',
        'original_charges',
        'unit_price',
        'original_unit_price',
        'link',
        'start_counter',
        'remains',
        'quantity',
        'user_id',
        'service_id',
        'category_id',
        'custom_comments',
        'mode',
        'source',
        'drip_feed_id',
        'order_viewable_time',
        'text_area_1',
        'text_area_2',
        'additional_inputs',
        'refill_status',
        'refill_order_status',
        'provider_order_id',
        'auto_order_response',
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the service that owns the order.
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
