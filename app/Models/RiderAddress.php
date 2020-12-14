<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class RiderAddress extends Model
{
    /**
     * @var string
     */
    protected $table = 'rider_address';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'rider_id',
        'address',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'rider_id' => 'int'
    ];

}
