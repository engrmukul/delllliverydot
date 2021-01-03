<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 */
class Rider extends Model
{
    /**
     * @var string
     */
    protected $table = 'riders';

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
        'isNew',
        'device_token',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts  = [

    ];

    public function riderProfile()
    {
        return $this->hasOne(RiderProfile::class,'rider_id','id');
    }

    //SET MUTATOR
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function riderSetting(){
        return $this->hasOne('App\Models\RiderSetting');
    }

    public function riderAddress(){
        return $this->hasOne('App\Models\RiderAddress');
    }


}
