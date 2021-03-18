<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class GeneralSetting extends Model
{
    /**
     * @var string
     */
    protected $table = 'general_settings';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'point_value'
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'point_value' => 'double',
    ];

}
