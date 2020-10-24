<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class AppHomeScreenLayoutSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'app_home_screen_layout_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'row',
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

    ];

}
