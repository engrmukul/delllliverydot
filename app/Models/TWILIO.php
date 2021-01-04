<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class TWILIO extends Model
{
    /**
     * @var string
     */
    protected $table = 'TWILIO';

    /**
     * @var array
     */
    protected $fillable = [
        'TWILIO_AUTH_TOKEN',
        'TWILIO_SID',
        'TWILIO_VERIFY_SID'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
