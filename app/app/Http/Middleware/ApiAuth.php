<?php

namespace App\Http\Middleware;

use App\Helpers\AuthHelper;
use App\Repositories\ModelRepository;
use App\User;
use Closure;

class ApiAuth
{
    protected $model_user;

    public function __construct(User $user)
    {
        $this->model_user = new ModelRepository($user);
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
                'status' => '401 (Unauthorized)',
                'message' => 'Please add the api authentication token in your request header.',
                'data' => '',
            ], 401);

        $user = AuthHelper::instance()->user($request,$this->model_user);
        if (!$user) {
            return response()->json([
                'status' => '422 (Unauthorized)',
                'message' => 'Invalid api authentication token.',
                'data' => '',
            ], 422);
        }

        if ($user->api_token_expiry_date < now()) {
            return response()->json([
                'status' => '401 (Unauthorized)',
                'message' => 'Your token is expired, request a refresh using your refresh token on the refresh route.',
                'data' => '',
            ], 401);
        }
        return $next($request);
    }
}
