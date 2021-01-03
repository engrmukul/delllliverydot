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

    public function customerProfile(){
        return $this->hasOne('App\Models\CustomerProfile');
    }

}
