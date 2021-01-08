<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FavoriteRestaurant extends Model
{
    /**
     * @var string
     */
    protected $table = 'favorite_restaurants';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'customer_id' =>'int',
        'restaurant_id' => 'int'
    ];

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class,'id', 'restaurant_id');
    }

    public function RestaurantDetails()
    {
        return $this->hasOne(RestaurantProfile::class,'restaurant_id', 'restaurant_id');
    }

}
