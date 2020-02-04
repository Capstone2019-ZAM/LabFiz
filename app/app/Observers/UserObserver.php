<?php


namespace App\Observers;


use App\Helpers\AuthHelper;
class UserObserver
{
    public function creating($user){
            $user->api_token = AuthHelper::instance()->create_auth_token();
            $user->api_token_expiry_date = AuthHelper::instance()->create_auth_token_expiry();
            $user->api_refresh_token = AuthHelper::instance()->create_auth_token();
    }
}
