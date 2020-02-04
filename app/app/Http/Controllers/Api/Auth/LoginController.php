<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Repositories\ModelRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

class LoginController extends Controller
{
    protected $model_user;

    public function __construct(User $user)
    {
        $this->model_user = new ModelRepository($user);
    }

    public function refresh(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        $user = new stdClass();
        try {
            $user = $this->model_user->getByColumn($request->api_refresh_token, 'api_refresh_token');
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        if (!$user) {
            $result['message'] = 'Refresh token not found.';
            return response($result, 400);
        }

        $api_token_refresh_date = $user->api_token_expiry_date;
        if ($api_token_refresh_date > now()) {
            $result['message'] = 'Api token has not expired yet. Nothing to refresh.';
            return response($result, 400);
        }

        $user = $this->model_user->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data()
        );

        $result['data'] = [
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $user->api_refresh_token
        ];

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Api token refreshed successfully';
        return response($result, 200);
    }

    public function login(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        $user = new stdClass();
        try {
            $user = $this->model_user->getByColumn($request->email, 'email');
        } catch (QueryException $ex) {
            $result['message'] = 'User not found.';
            return response($result, 400);
        }

        $pass = Hash::check($request->password, $user->password);
        if (!$pass) {
            $result['message'] = 'Invalid password.';
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User logged in successfully.';
        $result['data'] = [
            'email' => $user->email,
            'role' => $user->roles->pluck('name')[0],
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $user->api_refresh_token
        ];

        return response($result, 200);
    }
}
