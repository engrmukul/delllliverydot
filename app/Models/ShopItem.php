<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class ShopItem extends Model
{
    /**
     * @var string
     */
    protected $table = 'shop_items';
    public $timestamps = false;
    protected $appends = ['coupon','ratting','delivery_fee','description'];


    /**
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'name',
        'price',
        'discount',
        'image',
        'description',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts  = [
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

    public function getDescriptionAttribute(){
        return "Grocery items, Oil, Vegetables, Fruits";
    }

    public function getPriceAttribute($price){
        return $price . " TK";
    }

    public function getDiscountAttribute($discount){
        return $discount . " %";
    }

}
