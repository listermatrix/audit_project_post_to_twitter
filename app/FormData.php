<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormData extends Model
{
    use SoftDeletes;


    protected $fillable =
        [
            'username',
            'f_name',
            'l_name',
        ];
}
