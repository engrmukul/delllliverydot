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
        'total_code',
        'total_used_code',
        'discount_type',
        'discount',
        'minimum_order',
        'description',
        'food_id',
        'restaurant_id',
        'category_id',
        'coupon_type',
        'start_date',
        'expire_at',
        'enabled',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'start_date'  => 'date:Y-m-d',
        'expire_at'  => 'date:Y-m-d',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

}
