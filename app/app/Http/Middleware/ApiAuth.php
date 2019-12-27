<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization'))
            return $next($request);

        return response()->json([
            'status' => '401 (Unauthorized)',
            'message' => 'You are not authorized to access this route.',
            'data' => '',
        ], 401);
    }
}
