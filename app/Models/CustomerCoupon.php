<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class CustomerCoupon extends Model
{
    /**
     * @var string
     */
    protected $table = 'customer_coupons';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'coupon_code',
        'discount',
        'used_date',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
