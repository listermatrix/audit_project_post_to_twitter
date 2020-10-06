<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAuth extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'twitter_screen_name',
        'twitter_oauth_token',
        'twitter_oauth_token_secrete',
    ];
}
