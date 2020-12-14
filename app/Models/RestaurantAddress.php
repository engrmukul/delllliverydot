<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class RestaurantAddress extends Model
{
    /**
     * @var string
     */
    protected $table = 'restaurant_address';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'restaurant_id',
        'address',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'restaurant_id' => 'int'
    ];

}
