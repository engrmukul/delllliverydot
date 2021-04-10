<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class GOOGLE extends Model
{
    /**
     * @var string
     */
    protected $table = 'GOOGLE';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'SERVER_API_KEY',
        'distance',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
