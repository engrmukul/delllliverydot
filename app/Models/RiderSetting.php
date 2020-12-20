<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 * @package App\Models
 */
class RiderSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'rider_settings';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'rider_id',
        'notification',
        'popup_notification',
        'sms',
        'offer_and_promotion',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'notification' => 'boolean',
        'popup_notification' => 'boolean',
        'sms' => 'boolean',
        'offer_and_promotion' => 'boolean',
    ];

}
