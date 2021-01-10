<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FavoriteShop extends Model
{
    /**
     * @var string
     */
    protected $table = 'favorite_shops';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'shop_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'customer_id' =>'int',
        'shop_id' => 'int'
    ];

    public function shops()
    {
        return $this->hasOne(Food::class,'id', 'shop_id');
    }

}
