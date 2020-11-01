<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Delivery extends Model
{
    /**
     * @var string
     */
    protected $table = 'deliveries';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'from_name',
        'from_phone',
        'from_email',
        'from_address',
        'to_name',
        'to_phone',
        'to_email',
        'to_address',
        'to_area',
        'to_district',
        'to_post_code',
        'item_name',
        'item_type',
        'width',
        'height',
        'length',
        'weight',
        'instructions',
        'pickup_time',
        'status',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
