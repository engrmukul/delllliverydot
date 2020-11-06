<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Rider extends Model
{
    /**
     * @var string
     */
    protected $table = 'riders';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'isVerified',
        'email_verified_at',
        'password',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
