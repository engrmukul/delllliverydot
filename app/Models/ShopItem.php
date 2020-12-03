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

}
