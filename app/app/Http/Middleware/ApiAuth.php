<?php

namespace App\Http\Middleware;

use App\Helpers\AuthHelper;
use App\Repositories\ModelRepository;
use App\User;
use Closure;

class ApiAuth
{
    protected $user_model;

    public function __construct(User $user)
    {
        $this->user_model = new ModelRepository($user);
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->header('Authorization'))
            return response()->json([
                'status' => '422 (Unprocessable Entity))',
                'message' => 'Please add the api authentication token in your request header.',
                'data' => '',
            ], 401);

        $user = AuthHelper::instance()->user($request,$this->user_model);
        if (!$user) {
            return response()->json([
                'status' => '422 (Unprocessable Entity)',
                'message' => 'Invalid api authentication token.',
                'data' => '',
            ], 422);
        }

        if ($user->api_token_expiry_date < now()) {
            return response()->json([
                'status' => '401 (Unauthorized)',
                'message' => 'Your token is expired, refresh your api auth token using the refresh route.',
                'data' => '',
            ], 401);
        }
        return $next($request);
    }
}
