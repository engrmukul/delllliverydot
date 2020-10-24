<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Coupon extends Model
{
    /**
     * @var string
     */
    protected $table = 'coupons';

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'discount_type',
        'discount',
        'description',
        'food_id',
        'restaurant_id',
        'category_id',
        'expire_at',
        'enabled',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
