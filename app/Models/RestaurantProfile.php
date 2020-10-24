<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class RestaurantProfile extends Model
{
    /**
     * @var string
     */
    protected $table = 'restaurant_profiles';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'restaurant_id',
        'name',
        'delivery_type',
        'delivery_fee',
        'delivery_time',
        'discount',
        'delivery_range',
        'mobile',
        'address',
        'latitude',
        'longitude',
        'closed_restaurant',
        'available_for_delivery',
        'feature_section',
        'sn',
        'image',
        'description',
        'information',
        'options',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
