<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthRefreshToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','issued_at','expires_at', 'black_listed', 'token'
    ];
}
