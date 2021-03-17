<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FoodVariant extends Model
{
    /**
     * @var string
     */
    protected $table = 'food_variants';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'food_id',
        'name',
        'price',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'price' => 'double',
        'food_id' => 'int',
    ];

    public function getNameAttribute($value)
    {
        return '';
    }

}
