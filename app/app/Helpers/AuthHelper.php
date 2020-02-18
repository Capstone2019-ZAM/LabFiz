<?php


namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AuthHelper
{
    public static function instance()
    {
        return new AuthHelper();
    }

    public function create_auth_token()
    {
        return Str::random(60);
    }

    public function create_auth_token_expiry()
    {
        return Carbon::now()->addSeconds(2592000)->toDateTimeString();
    }

    public function create_auth_data($gen_token = true)
    {
        return [
            'api_refresh_token' => $this->create_auth_token(),
            'api_token_expiry_date' => $this->create_auth_token_expiry()
        ] + ($gen_token ? ['api_token' => $this->create_auth_token()] : []);
    }
}
