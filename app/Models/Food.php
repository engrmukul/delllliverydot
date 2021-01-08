<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Food extends Model
{
    /**
     * @var string
     */
    protected $table = 'foods';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'short_description',
        'image',
        'price',
        'discount_price',
        'description',
        'ingredients',
        'unit',
        'package_count',
        'weight',
        'featured',
        'deliverable_food',
        'restaurant_id',
        'category_id',
        'options',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'discount_price' => 'double',
    ];

    public function categories()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function restaurants()
    {
        return $this->hasOne(Restaurant::class,'id','restaurant_id');
    }

    public function favoriteFoodId()
    {
        return $this->hasOne('App\Models\FavoriteFood');
    }

    public function foodVariants()
    {
        return $this->hasMany(FoodVariant::class);
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }

}
