<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class OrderDetail extends Model
{
    /**
     * @var string
     */
    protected $table = 'order_details';

    /**
     * @var array
     */
    protected $fillable = [
        'order_id',
        'food_id',
        'food_variant_id',
        'food_price',
        'food_quantity',
        'extra_id',
        'extra_price',
        'sub_total',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
