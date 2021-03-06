<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class CustomerSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'settings';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'notification',
        'sms',
        'offer_and_promotion',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
