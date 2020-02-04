<?php


namespace App\Observers;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating($user){
            $user->api_token = Str::random(60);
            $timestamp = Carbon::now()->addSeconds(30);
            $user->api_token_expiry_date = $timestamp->format('Y-m-d H:i:s');
            $user->api_refresh_token = Str::random(60);
    }
}
