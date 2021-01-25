<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class PUSHER extends Model
{
    /**
     * @var string
     */
    protected $table = 'PUSHER';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'PUSHER_APP_ID',
        'PUSHER_APP_KEY',
        'PUSHER_APP_SECRET',
        'PUSHER_APP_CLUSTER'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
