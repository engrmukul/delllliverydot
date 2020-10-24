<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Shop extends Model
{
    /**
     * @var string
     */
    protected $table = 'shops';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
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
        'closed_shop',
        'available_for_delivery',
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
