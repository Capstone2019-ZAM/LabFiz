<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lab\CreateRequest;
use App\Lab;
use App\Repositories\ModelRepository;
use App\User;
use Exception;
use Illuminate\Http\Request;

class LabController extends Controller
{
    protected $model_lab;
    protected $model_user;

    public function __construct(Lab $lab, User $user)
    {
        $this->model_lab = new ModelRepository($lab);
        $this->model_user = new ModelRepository($user);
    }

    public function get($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $lab = $this->model_lab->getById($id);
            $result['data'] = $lab;
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Lab retrieved succesfully.';
        return response($result, 200);
    }

    public function get_all()
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];
        $result['data'] = $this->model_lab->get();
        $result['status'] = '200 (Ok)';
        $result['message'] = 'All Labs retrieved succesfully.';
        return response($result, 200);
    }

    public function create(CreateRequest $request)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => []];
        $header = $request->header('Authorization');
        $user = $this->model_user->getByColumn($header, 'api_token');

        try {
            $result['data'] = $this->model_lab->create(
                [
                    'name' => $request->name,
                    'location' => $request->location,
                    'user_id' => $user->id
                ]
            );
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Created lab succesfully!';
        return response($result, 200);
    }

    public function delete($id)
    {
        $result = ['status' => '400 (Bad Request)', 'message' => '', 'data' => ''];

        try {
            $result['data'] = $this->model_lab->deleteById($id);
        } catch (Exception $ex) {
            $result['message'] = $ex->getMessage();
            return response($result, 400);
        }

        $result['status'] = '200 (Ok)';
        $result['message'] = 'Lab deleted succesfully';
        return response($result, 200);
    }
}
