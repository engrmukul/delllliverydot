<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
