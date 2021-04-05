<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Restaurant extends Model
{
    /**
     * @var string
     */
    protected $table = 'restaurants';
    protected $appends = ['isFavorite'];


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'isVerified',
        'email_verified_at',
        'password',
        'status',
        'is_favorite',
        'is_discounted',
        'is_trending',
        'is_popular',
        'device_token',
        'created_at',
        'updated_at',
    ];

    /**SELECT * FROM `foods`
     * @var array
     */
    protected $casts  = [
        'isFavorite' => 'boolean'
    ];

    public function restaurantDetails(){
        return $this->hasOne('App\Models\RestaurantProfile');
    }

    public function restaurantSetting(){
        return $this->hasOne('App\Models\RestaurantSetting');
    }

    public function restaurantAddress(){
        return $this->hasOne('App\Models\RestaurantAddress');
    }

    public function coupon(){
        return $this->getCoupon();
    }

    public function getCoupon(){
        return $this->hasOne('App\Models\Coupon');

    }

    public function foods(){
        return $this->hasMany('App\Models\Food');
    }

    public function ratting(){
        return $this->hasMany('App\Models\RestaurantReview');
    }

    public function favoriteRestaurant(){
        return $this->hasOne('App\Models\FavoriteRestaurant');
    }

    public function getIsFavoriteAttribute(){
        return count((array)$this->favoriteRestaurant) > 0 ? true : false;
    }

}
