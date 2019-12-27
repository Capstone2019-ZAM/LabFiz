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
        $token = $request->header('Authorization');
        $user = User::where('api_token', $token)->first();
        if (!$user)
            return response()->json([
                'message' => 'User not found.'
            ]);

        $pass = Hash::check($request->password, $user->password);
        if (!$pass)
            return response()->json([
                'message' => 'Invalid password.'
            ]);

        $response = ['api_token' => null];
        return response()->json([
            'message' => 'User logged in successfully.',
            'data' => [
                'email' => $user->email,
                'role' => $user->roles->pluck('name')[0],
                'token' => $token
            ]
        ]);
    }
}
