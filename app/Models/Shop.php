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
    protected $appends = ['coupon','ratting','isFavorite'];



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
        'delivery_range' => 'int',
        'delivery_fee' => 'int',
        'discount' => 'int',
        'available_for_delivery' => 'int',
        'closed_shop' => 'int',
        'isFavorite' => 'boolean',
    ];

    public function getDeliveryFeeAttribute(){
        return "Free delivery";
    }

    public function getCouponAttribute(){
        return "Use DOT100";
    }

    public function getRattingAttribute(){
        return "4.5(250)";
    }

    public function favoriteShop()
    {
        return $this->hasOne('App\Models\FavoriteShop');
    }

    public function getIsFavoriteAttribute(){
        return count((array)$this->favoriteShop) > 0 ? true : false;
    }

}
