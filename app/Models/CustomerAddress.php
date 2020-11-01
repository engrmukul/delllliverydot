<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class CustomerAddress extends Model
{
    /**
     * @var string
     */
    protected $table = 'customer_address';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'address',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
