<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Point extends Model
{
    /**
     * @var string
     */
    protected $table = 'points';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'order_id',
        'amount',
        'point'
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'amount' => 'double',
        'point' => 'int',
    ];

    public function orders()
    {
        return $this->hasOne(Order::class,'id', 'order_id');
    }

}
