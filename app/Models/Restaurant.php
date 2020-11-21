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
        'email_verified_at',
        'password',
        'remember_token',
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
