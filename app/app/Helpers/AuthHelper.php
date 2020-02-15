<?php


namespace App\Helpers;

use App\Repositories\ModelRepository;
use App\User;
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
        return Carbon::now()->addSeconds(2592000)->format('Y-m-d H:i:s');
    }

    public function user($request, ModelRepository $user)
    {
        $header = $request->header('Authorization');
        return $user->getByColumn($header, 'api_token');
    }

    public function create_auth_data()
    {
        return [
            'api_token' => $this->create_auth_token(),
            'api_refresh_token' => $this->create_auth_token(),
            'api_token_expiry_date' => $this->create_auth_token_expiry()
        ];
    }
}
