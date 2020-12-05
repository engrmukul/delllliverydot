<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Extra extends Model
{
    /**
     * @var string
     */
    protected $table = 'extras';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'food_id',
        'extra_group_id',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'price' => 'double',
        'food_id' => 'int',
    ];

}
