<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class FilterOption extends Model
{
    /**
     * @var string
     */
    protected $table = 'filter_options';

    /**
     * @var array
     */
    protected $fillable = [
        'filter_type',
        'title',
        'slug',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];
}
