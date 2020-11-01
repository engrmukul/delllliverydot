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

    ];

}