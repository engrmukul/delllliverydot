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
        'coup_code'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
