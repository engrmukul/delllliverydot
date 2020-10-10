<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
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
