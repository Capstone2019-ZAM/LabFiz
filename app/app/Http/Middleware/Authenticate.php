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
            $user = Auth::guard('api')->user();
            if ($user && $user->api_token_expiry_date < now()) {
                return response()->json([
                    'status' => '401 (Unauthorized)',
                    'message' => 'Your authentication token has expired, you will need to refresh it using the /refresh route.',
                    'data' => '',
                ], 401);
            }
        }

        return $next($request);
    }
}
