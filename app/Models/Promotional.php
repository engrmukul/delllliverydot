<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Promotional extends Model
{
    /**
     * @var string
     */
    protected $table = 'promotional_banners';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
