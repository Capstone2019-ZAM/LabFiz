<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RefreshRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $user_service;

    public function __construct(RestServiceContract $user_service)
    {
        $this->user_service = $user_service;
    }

    public function get($id)
    {
        $res = $this->user_service->get($id);
        return response($res['response'], $res['status']);
    }

    public function get_all()
    {
        $res = $this->user_service->get_all();
        return response($res['response'], $res['status']);
    }

    public function register(RegisterRequest $request)
    {
        $res = $this->user_service->register($request);
        return response($res['response'], $res['status']);
    }
    public function update(RegisterRequest $request)
    {
        $res = $this->user_service->update($request);
        return response($res['response'], $res['status']);
    }

    public function delete($id)
    {
        $res = $this->user_service->delete($id);
        return response($res['response'], $res['status']);
    }

    public function refresh()
    {
        $res = $this->user_service->refresh();
        return response($res['response'], $res['status']);
    }

    public function login(LoginRequest $request)
    {
        $res = $this->user_service->login($request);
        return response($res['response'], $res['status']);
    }

    public function logout()
    {
        $res = $this->user_service->logout();
        return response($res['response'], $res['status']);
    }
}
