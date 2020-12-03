<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class ShopPromotion extends Model
{
    /**
     * @var string
     */
    protected $table = 'shop_promotions';

    /**
     * @var array
     */
    protected $fillable = [
        'message',
        'image',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
