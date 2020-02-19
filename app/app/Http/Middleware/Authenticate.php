<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!empty($guards) && $guards[0] === 'api') {
            // handle empty bearer token
            $bearer =$request->header('Authorization');
            if(!$bearer || explode(" ", $bearer)[0] !== 'Bearer')
                return response()->json([
                    'status' => '422 (Unauthorized)',
                    'message' => 'Authorization field of request header requires a Bearer token.',
                    'data' => '',
                ], 401);

            // check if bearer token is valid
            $user = Auth::guard('api')->user();
            if(!$user){
                return response()->json([
                    'status' => '422 (Unauthorized)',
                    'message' => 'Invalid authentication token. Please make sure the bearer token is valid.',
                    'data' => '',
                ], 401);
            }

            // check if bearer token has expired
            if ($user && $user->api_token_expiry_date < now()) {
                return response()->json([
                    'status' => '401 (Unauthorized)',
                    'message' => 'Your authentication token has expired, request a refresh using the refresh route.',
                    'data' => '',
                ], 401);
            }
        }

        return $next($request);
    }
}
