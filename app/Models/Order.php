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
        'order_date'  => 'date:Y-m-d m:i:s a',
        'customer_id'  => 'int',
        'total_price'  => 'double',
        'discount'  => 'double',
        'vat'  => 'double',
        'delivery_fee'  => 'double',
        'restaurant_id'  => 'int',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class,'id','restaurant_id');
    }

    public function RestaurantDetails()
    {
        return $this->hasOne(RestaurantProfile::class,'restaurant_id','restaurant_id');
    }

    public function customerDetails()
    {
        return $this->hasOne(CustomerProfile::class,'customer_id','customer_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class,'id', 'customer_id');
    }

    public function rider()
    {
        return $this->hasOne(Rider::class,'id', 'rider_id');
    }

    public function getOrderStatusAttribute($value)
    {
        if($value == "rider_accepted"){
            return "On the way to restaurant";
        }elseif ($value == "delivery_on_the_way"){
            return "On the way to customer";
        }elseif ($value == "delivered"){
            return "Delivered";
        }else{
            return $value;
        }
    }


}
