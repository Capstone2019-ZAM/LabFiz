<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RefreshRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\ModelRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserService implements RestServiceContract
{
    protected $model_user;

    public function __construct(User $user)
    {
        $this->model_user = new ModelRepository($user);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_user->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Users retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function register(RegisterRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try{
            $user = $this->model_user->create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'password' => $request->password,
                    'role' => $request->role,
                    'department' => $request->department,
                    'email' => $request->email
                ]);

            $result['data'] = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'password' => $user->password,
                'role' => $user->role,
                'department' => $user->department,
                'email' => $user->email,
                'api_token' => $user->api_token,
                'token_type' => $user->api_token_type,
                'expires_at' => $user->api_token_expiry_date,
                'refresh_token' => $user->api_refresh_token
            ];

        }catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['data' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User registered successfully';
        return ['response' => $result, 'status' => 200];
    }

    public function refresh(RefreshRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $user = $this->model_user->getByColumn($request->api_refresh_token, 'api_refresh_token');
        } catch (QueryException $ex) {
            $result['message'] = $ex->getMessage();
            return ['data' => $result, 'status' => 400];
        }

        if (!$user) {
            $result['message'] = 'Refresh token not found.';
            return ['data' => $result, 'status' => 400];
        }

        $api_token_refresh_date = $user->api_token_expiry_date;
        if ($api_token_refresh_date > now()) {
            $result['message'] = 'Api token has not expired yet. Nothing to refresh.';
            return ['data' => $result, 'status' => 400];
        }

        $user = $this->model_user->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data()
        );

        $result['data'] = [
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $user->api_refresh_token
        ];

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Api token refreshed successfully';
        return ['response' => $result, 'status' => 200];
    }

    public function login(LoginRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $user = $this->model_user->getByColumn($request->email, 'email');
        } catch (QueryException $ex) {
            $result['message'] = 'User not found.';
            return ['data' => $result, 'status' => 400];
        }

        $pass = Hash::check($request->password, $user->password);
        if (!$pass) {
            $result['message'] = 'Invalid password.';
            return ['data' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User logged in successfully.';
        $result['data'] = [
            'email' => $user->email,
            'role' => $user->roles->pluck('name')[0],
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $user->api_refresh_token
        ];

        return ['response' => $result, 'status' => 200];
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function create(FormRequest $request)
    {
        // TODO: Implement create() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}