<?php

namespace App\Http\Middleware;

use App\Repositories\ModelRepository;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    protected $user_model;

    /**
     * AdminOnly constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user_model = new ModelRepository($user);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('api')->user()->hasRole('admin') 
        && !Auth::guard('api')->user()->hasPermissionTo('view all users') )
            return response()->json([
                'status' => '401 (Unauthorized)',
                'message' => 'Only admins have authorized access for this route.',
                'data' => '',
            ], 401);

        return $next($request);
    }
}
