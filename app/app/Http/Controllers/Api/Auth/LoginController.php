<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RefreshRequest;
use App\Http\Requests\User\RegisterRequest;

class LoginController extends Controller
{
    protected $user_service;

    public function __construct(RestServiceContract $user_service)
    {
        $this->user_service = $user_service;
    }

    public function get($id)
    {
        $res = $this->user_service->get($id, ['id','first_name','last_name']);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->user_service->get_all(['id','first_name','last_name']);
        return response($res['response'], $res['status']);
    }

    public function register(RegisterRequest $request)
    {
        $res = $this->user_service->register($request);
        return response($res['response'], $res['status']);
    }

    public function refresh(RefreshRequest $request)
    {
        $res = $this->user_service->refresh($request);
        return response($res['response'], $res['status']);
    }

    public function login(LoginRequest $request)
    {
        $res = $this->user_service->login($request);
        return response($res['response'], $res['status']);
    }
}
