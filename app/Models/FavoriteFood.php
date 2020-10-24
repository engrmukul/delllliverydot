<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FavoriteFood extends Model
{
    /**
     * @var string
     */
    protected $table = 'favorite_foods';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'food_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
