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
        'device_token',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

    public function restaurantDetails(){
        return $this->hasOne('App\Models\RestaurantProfile');
    }

    public function coupon(){
        return $this->hasOne('App\Models\Coupon');
    }

    public function foods(){
        return $this->hasMany('App\Models\Food');
    }

    public function ratting(){
        return $this->hasMany('App\Models\RestaurantReview');
    }

}
