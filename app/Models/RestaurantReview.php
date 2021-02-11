<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder\Class_;

/**
 * Class Attribute
 * @package App\Models
 */
class RestaurantReview extends Model
{
    /**
     * @var string
     */
    protected $table = 'restaurant_reviews';

    /**
     * @var array
     */
    protected $fillable = [
        'review',
        'rate',
        'customer_id',
        'restaurant_id',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', customer_id);
    }
    public function restaurant()
    {
        return $this->hasOne(restaurant::class, 'id', restaurant_id);
    }

}
