<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FCM extends Model
{
    /**
     * @var string
     */
    protected $table = 'FCM';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'SERVER_API_KEY'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
