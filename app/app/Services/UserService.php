<?php


namespace App\Services;


use App\AuthRefreshToken;
use App\Contracts\RestServiceContract;
use App\Helpers\AuthHelper;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\ModelRepository;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserService implements RestServiceContract
{
    protected $user_model, $role_model, $auth_token_model;

    public function __construct(User $user, Role $role, AuthRefreshToken $auth_token)
    {
        $this->user_model = new ModelRepository($user);
        $this->role_model = new ModelRepository($role);
        $this->auth_token_model = new ModelRepository($auth_token);
    }

    public function get($id, array $columns = ['*'])
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $columns = ['id', 'first_name', 'last_name', 'department', 'email', 'created_at'];
            $result['data'] = $this->user_model->getById($id, $columns);        
            $result['data']['role'] = $result['data']->getRoleNames();
    
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
        $columns = ['id', 'first_name', 'last_name', 'department', 'email', 'created_at'];
        $result = ['status' => '200 (Ok)', 'message' => 'All Users retrieved successfully.', 'data' => ''];
        $result['data'] = $this->user_model->get($columns);
        foreach( $result['data'] as $item){
            $v = $item->getRoleNames();
            // $result['data']['role'] =$v;
        }
        return ['response' => $result, 'status' => 200];
    }

    public function register(RegisterRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $user = $this->user_model->create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'password' => Hash::make($request->password),
                    'department' => $request->department,
                    'email' => $request->email
                ]);

            // bind user role
            $user->assignRole($this->role_model->where('name', $request->role)->first()->id);

            $result['data'] = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'password' => $user->password,
                'roles' => $user->getRoleNames(),
                'department' => $user->department,
                'email' => $user->email,
            ];

        } catch (Exception $ex) {
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

        // check if api auth token has expired
        $api_token_refresh_date = $user->api_token_expiry_date;
        if ($api_token_refresh_date > now()) {
            $result['message'] = 'Authentication token has not expired yet.';
            return ['response' => $result, 'status' => 400];
        }

        // check if the refresh token is black listed
        $auth_refresh_token = $user->auth_refresh_token()->get()[0];
        if ($auth_refresh_token->black_listed) {
            $result['message'] = 'Refresh token is blacklisted and cant be used any longer. Generate a new api and refresh token pair using the login route.';
            return ['response' => $result, 'status' => 400];
        }

        // check if the refresh token has expired
        if ($auth_refresh_token->expires_at < now()) {
            $result['message'] = 'Refresh token has expired. Generate a new api and refresh token pair using the login route.';
            $this->auth_token_model->updateOrCreate(
                ['client_id' => $user->id],
                [
                    'black_listed' => true
                ]
            );
            return ['response' => $result, 'status' => 400];
        }

        // refresh token is still valid, update the api token
        $user = $this->user_model->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data(true, false)
        );

        $result['data'] = [
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $auth_refresh_token->token
        ];

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Authentication token refreshed successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function login(LoginRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $result['message'] = 'Invalid login credentials.';
            return ['response' => $result, 'status' => 400];
        }

        $user = Auth::user();
        $user = $this->user_model->updateById(
            $user->id,
            AuthHelper::instance()->create_auth_data(true, false)
        );

        $auth_token = $this->auth_token_model->updateOrCreate(
            ['client_id' => $user->id],
            [
                'client_id' => $user->id,
                'token_type' => 'Bearer',
                'black_listed' => false
            ] + AuthHelper::instance()->create_auth_data(false, true)
        );

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User logged in successfully.';
        $result['data'] = [
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
            'token' => $user->api_token,
            'token_type' => $user->api_token_type,
            'expires_at' => $user->api_token_expiry_date,
            'refresh_token' => $auth_token->token
        ];

        return ['response' => $result, 'status' => 200];
    }

    public function logout()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $user = Auth::guard('api')->user();

        if (!$user) {
            $result['message'] = 'No currently authenticated user to logout.';
            return ['response' => $result, 'status' => 400];
        }

        if ($user) {
            $this->user_model->updateById(
                $user->id,
                [
                    'api_token' => null,
                    'api_token_expiry_date' => Carbon::now()->toDateTimeString()
                ]
            );

            $this->auth_token_model->updateOrCreate(
                ['client_id' => $user->id],
                [
                    'token' => null,
                    'black_listed' => true,
                    'expires_at' => Carbon::now()->toDateTimeString()
                ]
            );
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User logged out successfully.';
        return ['response' => $result, 'status' => 200];
    }

    public function create(FormRequest $request){

    }

    public function update(RegisterRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $user = $this->user_model->updateOrCreate(['id'=>$request->id],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    //'password' => Hash::make($request->password),
                    'department' => $request->department,
                    'email' => $request->email
                ]);

            // remove all user role and assign new --refactor
            $user->removeRole('admin');
            $user->removeRole('student');
            $user->removeRole('inspector');
            $user->assignRole($this->role_model->where('name', $request->role)->first()->id);

            $result['data'] = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                //'password' => $user->password,
                'roles' => $user->getRoleNames(),
                'department' => $user->department,
                'email' => $user->email,
            ];

        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User updated successfully';
        return ['response' => $result, 'status' => 200];
    }

    public function delete($id)
    {
        
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $current_user = Auth::guard('api')->user();
            if ( $current_user->id != $id){
                $user = $this->user_model->deleteById($id);
            }
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return ['response' => $result, 'status' => 400];
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'User deleted successfully';
        return ['response' => $result, 'status' => 200];
    

    }
}
