<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class HelpAndSupport extends Model
{
    /**
     * @var string
     */
    protected $table = 'help_and_supports';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'question',
        'answer',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
