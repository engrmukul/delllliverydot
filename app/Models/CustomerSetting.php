<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class RestaurantSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'restaurant_settings';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'restaurant_id',
        'notification',
        'popup_notification',
        'sms',
        'offer_and_promotion',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
