<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __construct()
    {

    }

    public function login(Request $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $user = User::where('email', $request->email)->first();
        if (!$user) {
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
            'api_refresh_token' => $user->api_refresh_token
        ];

        return response($result, 200);
    }
}
