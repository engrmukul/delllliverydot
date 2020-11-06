<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class RiderOrder extends Model
{
    /**
     * @var string
     */
    protected $table = 'rider_orders';

    /**
     * @var array
     */
    protected $fillable = [
        'rider_id',
        'order_id',
        'ride_date',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

}
