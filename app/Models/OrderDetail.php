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
    public $timestamps = false;

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
        "order_id" => 'int',
        "food_id" => 'int',
        "food_variant_id" => 'int',
        "food_price" => 'double',
        "food_quantity" => 'int',
        "extra_price" => 'double',
        "sub_total" => 'double',
    ];

    public function foods()
    {
        return $this->hasOne(Food::class, 'id','food_id');
    }

    public function foodVariants()
    {
        return $this->hasMany(FoodVariant::class, 'id','food_variant_id');
    }

    public function extra()
    {
        return $this->hasMany(Extra::class);
    }

    public function getFoodPriceAttribute($value)
    {
        return number_format($value,2);
    }

    public function getExtraPriceAttribute($value)
    {
        return number_format($value,2);
    }

    public function getSubTotalAttribute($value)
    {
        return number_format($value,2);
    }

}
