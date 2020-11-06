<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'delivery_address',
        'order_date',
        'order_status',
        'payment_method',
        'payment_status',
        'total_price',
        'discount',
        'vat',
        'delivery_fee',
        'instructions',
        'restaurant_id',
        'coupon_code'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function RestaurantDetails()
    {
        return $this->hasOne(RestaurantProfile::class,'restaurant_id','restaurant_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class,'id', 'customer_id');
    }


}
