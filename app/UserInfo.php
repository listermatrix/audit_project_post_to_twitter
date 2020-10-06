<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use SoftDeletes;



    protected  $fillable = [

        'username',
        'f_name',
        'l_name',
        'email_address',
        'mobile_number',
    ];


}
