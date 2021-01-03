<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class TermsAndCondition extends Model
{
    /**
     * @var string
     */
    protected $table = 'terms_and_conditions';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'description',
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
