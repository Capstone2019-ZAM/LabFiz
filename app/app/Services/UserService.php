<?php


namespace App\Services;


use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserService implements RestServiceContract
{
    protected $user_model, $role_model;

    public function __construct(User $user, Role $role)
    {
        $this->user_model = new ModelRepository($user);
        $this->role_model = new ModelRepository($role);
    }

    public function get($id, array $columns = ['*'])
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $columns = ['id', 'first_name', 'last_name','department', 'email', 'created_at'];
            $result['data'] = $this->user_model->getById($id, $columns);
        } catch (Exception $ex) {
            $result['message'] = 'Could not find user record.';
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User retrieved successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function get_all(array $columns = ['*'])
    {
        $columns = ['id', 'first_name', 'last_name','department', 'email','created_at'];
        $result = ['status' => '200 (Ok)', 'message' => 'All Users retrieved successfully.', 'data' => ''];
        $result['data'] = $this->user_model->get($columns);
        return ['response' => $result, 'status' => 200];
    }

    public function register(RegisterRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try{
            $user = $this->user_model->create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'password' => $request->password,
                    'role' => $request->role,
                    'department' => $request->department,
                    'email' => $request->email
                ]);

            // bind user role
            $user->assignRole($this->role_model->where('name',$request->role)->first()->id);

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

        }catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User registered successfully';
        return ['response' => $result, 'status' => 200];
    }

    public function refresh()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $user = Auth::guard('api')->user();

        $api_token_refresh_date = $user->api_token_expiry_date;
        if ($api_token_refresh_date > now()) {
            $result['message'] = 'Authentication token has not expired yet.';
            return ['response' => $result, 'status' => 400];
        }

        $user = $this->user_model->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data(false)
        );

        $result['data'] = [
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $user->api_refresh_token
        ];

        $result['status'] = '200 (Ok)';
        $result['message'] = 'authentication token refreshed successfully';
        return ['response' => $result, 'status' => 200];
    }

    public function login(LoginRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $result['message'] = 'Invalid login credentials.';
            return ['response' => $result, 'status' => 400];
        }

        $user = Auth::user();
        $user = $this->user_model->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data()
        );

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

    public function logout()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $user = Auth::guard('api')->user();

        if(!$user){
            $result['message'] = 'No currently authenticated user to logout.';
            return ['response' => $result, 'status' => 400];
        }

        if ($user) {
            $this->user_model->updateById(
                $user->id,
                ['api_token' => null, 'api_refresh_token' => null]
            );
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User logged out successfully.';
        return ['response' => $result, 'status' => 200];
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
