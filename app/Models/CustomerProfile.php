<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class CustomerProfile extends Model
{
    /**
     * @var string
     */
    protected $table = 'customer_profiles';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'image',
        'dob',
        'spouse_dob',
        'father_dob',
        'mother_dob',
        'anniversary',
        'first_child_dob',
        'second_child_dob',
        'address',
        'short_biography',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

}
