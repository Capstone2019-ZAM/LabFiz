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

    public function create_auth_token_expiry($expiry = 2592000)
    {
        return Carbon::now()->addSeconds($expiry)->toDateTimeString();
    }

    public function create_auth_data($token = false, $refresh_token = false, $token_expiry = 2592000,  $refresh_token_expiry = 4592000)
    {
        return ($refresh_token ? [
                'token' => $this->create_auth_token(),
                'expires_at' => $this->create_auth_token_expiry($refresh_token_expiry)
            ] : []
            ) +
            ($token ? ['api_token' => $this->create_auth_token(),
                'api_token_expiry_date' => $this->create_auth_token_expiry($token_expiry)] : []
            );
    }
}
